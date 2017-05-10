<?php

namespace craft\query\controllers;

use craft\web\Controller;

/**
 * Query controller class
 */
class DefaultController extends Controller
{
    /**
     * For executing the database query.
     *
     * @return \yii\web\Response
     */
    public function actionExecute()
    {
        $this->requirePermission('utility:query');
        $this->requireAcceptsJson();
        $sql = \Craft::$app->getRequest()->getRequiredBodyParam('sql');

        if ($sql) {
            $result = \Craft::$app->getDb()->createCommand($sql)->queryAll();
        } else {
            $result = [];
        }

        return $this->asJson([
            'result' => $result
        ]);
    }
}