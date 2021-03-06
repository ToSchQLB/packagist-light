<?php


namespace app\commands;


use app\models\Package;
use app\models\PackageRelease;
use app\models\UserGitSourceToken;
use yii\console\Controller;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

class WorkerController extends Controller
{
    public function actionUpdatePackages()
    {
        $packages = Package::find()->joinWith('releases')->all();

        foreach ($packages as $package) {
            static::updatePackageReleases($package);
        }

        static::buildPackagesJson();
    }

    public static function buildPackagesJson()
    {
        $result   = ['packages' => []];
        $packages = Package::find()->joinWith('releases')->all();

        foreach ($packages as $package) {
            $releasList = [];
            foreach ($package->releases as $release) {
                $releasList[$release->version] = json_decode($release->packagist_json, true);
                //var_dump($releasList[$release->version]);
            }
            $result['packages'][$package->name] = $releasList;
        }

        $packagesFilePath = \Yii::getAlias('@app/web/packages.json');

        @unlink($packagesFilePath);

        file_put_contents(
            $packagesFilePath,
            json_encode(
                $result,
                JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRETTY_PRINT
            )
        );
    }

    /**
     * @param Package $package
     */
    public static function updatePackageReleases($package): void
    {
        \Yii::$app->urlManager->scriptUrl = \Yii::$app->params['scriptUrl'];
        $savedReleases = ArrayHelper::index($package->releases, 'release_id');

        $suffix = "";
        $token  = "";
        if ($package->private === 1) {
            $token  = UserGitSourceToken::token($package->git_source_id, $package->user_id);
            $suffix = "access_token={$token}";
        }

        $apiBaseUrl = $package->gitSource->baseUrl . 'api/v1/repos/';

        $releasesUrl = $apiBaseUrl . $package->repo_user . '/' . $package->repo_name . '/releases' . (empty($suffix) ? '' : '?' . $suffix);
        $contentUrl  = $apiBaseUrl . $package->repo_user . '/' . $package->repo_name . '/contents/composer.json?ref=';
        $readmeUrl   = !empty($package->readme_file) ? $apiBaseUrl . $package->repo_user . '/' . $package->repo_name . '/contents/' . $package->readme_file . '?ref=' : null;

        $json     = static::curl($releasesUrl);
        $releases = json_decode($json, true);
        if (!is_array($releases)) {
            $releases = [];
        }

//        var_dump($releases);
//        var_dump($package->name);

//        die();

        foreach ($releases as $releaseCnt => $release) {
            if (is_array($release) && !in_array($release['id'] ?? 0, array_keys($savedReleases) ?? [])) {
                $newRelease                       = new PackageRelease();
                $newRelease->package_id           = $package->id;
                $newRelease->release_id           = "" . $release['id'];
                $newRelease->title                = $release['name'] ?? $release['tag_name'];
                $newRelease->version              = $release['tag_name'];
                $newRelease->body                 = $release['body'];
                $newRelease->zip_url              = $release['zipball_url'];
                $newRelease->source_composer_json = static::getFileFromRepo($contentUrl . $release['tag_name'] . (empty($suffix) ? '' : '&' . $suffix));
                if ($releaseCnt == 0 && !is_null($readmeUrl)) {
                    $package->readme = static::getFileFromRepo($readmeUrl . $release['tag_name'] . (empty($suffix) ? '' : '&' . $suffix));
                    $package->save();
                }

                $composerJson            = json_decode($newRelease->source_composer_json, true);
                $composerJson['version'] = $newRelease->version;

                if ($package->private === 1) {
                    $zipDownloadUrl = $apiBaseUrl .
                        $package->repo_user . '/' .
                        $package->repo_name . '/' .
                        'archive/' .
                        $newRelease->version . '.zip?' .
                        $suffix;
                    $newRelease->zip_url = $zipDownloadUrl;
                    $newRelease->save();
                    $composerJson['dist'] = [
                        'type' => 'zip',
                        'url'  => Url::to(['download/private-release', 'id' => $newRelease->id]),
                    ];
                } else {
                    $composerJson['dist'] = [
                        'type' => 'zip',
                        'url'  => $newRelease->zip_url,
                    ];
                }
                $composerJson['name'] = $package->name;


                $newRelease->packagist_json = json_encode(
                    $composerJson,
                    JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_LINE_TERMINATORS | JSON_NUMERIC_CHECK | JSON_PRETTY_PRINT
                );

                $newRelease->save();
            }
        }
    }

    /**
     * @param string $releasesUrl
     *
     * @return bool|string
     */
    public static function curl(string $releasesUrl)
    {
        $ch = curl_init();

//        var_dump($releasesUrl);

        curl_setopt($ch, CURLOPT_URL, $releasesUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        foreach (\Yii::$app->params['proxy'] as $option => $value) {
            curl_setopt($ch, $option, $value);
        }

        $output = curl_exec($ch);

//        var_dump($output);

        curl_close($ch);

        return $output !== false ? $output : '[]';
    }

    /**
     * @param $fileUrl
     *
     * @return string
     */
    private static function getFileFromRepo($fileUrl): string
    {
        $output = static::curl($fileUrl);
        $data   = json_decode($output, true);

        return base64_decode($data['content'] ?? '==');
    }
}