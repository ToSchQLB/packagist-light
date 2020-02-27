<?php


namespace app\jobs;


use app\models\Package;
use app\models\PackageRelease;
use yii\helpers\ArrayHelper;
use yii\queue\closure\Job;

class PackageSyncJob extends Job
{
    /* @var int $packageId */
    public $packageId;

    public function execute($queue)
    {
        $package       = Package::find()->joinWith('releases')->where(['package.id' => $this->packageId])->one();

        if (is_null($package)) {
            return;
        }

        $savedReleases = ArrayHelper::index($package->releases, 'release_id');

        $apiBaseUrl = $package->gitSource->baseUrl . 'api/v1/repos/';

        $releasesUrl = $apiBaseUrl . $package->repo_user . '/' . $package->repo_name . '/releases';
        $contentUrl  = $apiBaseUrl . $package->repo_user . '/' . $package->repo_name . '/contents/composer.json?ref=';

        $releases = json_decode($this->curl($releasesUrl), true);

        foreach ($releases as $release) {
            if (!in_array($release['id'], array_keys($savedReleases) ?? [])) {
                $newRelease = new PackageRelease();
                $newRelease->package_id = $this->packageId;
                $newRelease->release_id = "".$release['id'];
                $newRelease->title = $release['name'] ?? $release['tag_name'];
                $newRelease->version = $release['tag_name'];
                $newRelease->body = $release['body'];
                $newRelease->zip_url = $release['zipball_url'];
                $newRelease->source_composer_json = $this->getComposerFile($contentUrl . $release['tag_name']);

                $newRelease->save();
            }
        }
    }

    /**
     * @param string $releasesUrl
     *
     * @return bool|string
     */
    private function curl(string $releasesUrl)
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $releasesUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_NOPROXY, 'localhost');

        $output = curl_exec($ch);

        curl_close($ch);

        return $output;
    }

    /**
     * @param $composerUrl
     *
     * @return string
     */
    private function getComposerFile( $composerUrl): string
    {
        $output = $this->curl($composerUrl);
        $data = json_decode($output, true);

        return base64_decode($data['content']);
    }


}