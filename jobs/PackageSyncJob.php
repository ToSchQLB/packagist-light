<?php


namespace app\jobs;


use app\commands\WorkerController;
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
        $package = Package::find()->joinWith('releases')->where(['package.id' => $this->packageId])->one();

        if (is_null($package)) {
            return;
        }

        WorkerController::updatePackageReleases($package);

        WorkerController::buildPackagesJson();
    }


}