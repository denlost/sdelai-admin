<?php

namespace frontend\controllers;

use Yii;
use common\models\User;
use frontend\forms\army\SetBanForm;
use frontend\models\search\UserSearch;
use yii\bootstrap\BaseHtml;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;

class UserController extends BaseController
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return array_merge(parent::behaviors(), [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['post'],
                    'bulk-delete' => ['post'],
                ],
            ],
        ]);
    }

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($id);

        if ($request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                'title' => 'Пользователь "' . $model->username . '"',
                'content' => $this->renderAjax('view', [
                    'model' => $this->findModel($id),
                ]),
                'footer' => Html::button('Закрыть', [
                    'class' => 'btn btn-default pull-left',
                    'data-dismiss' => 'modal'
                ]) . Html::a('Править', ['update', 'id' => $id], [
                    'class' => 'btn btn-primary',
                    'role' => 'modal-remote'
                ])
            ];
        } else {
            return $this->render('view', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Creates a new User model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $request = Yii::$app->request;
        $model = new User;

        if ($request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;

            if ($request->isGet) {
                return [
                    'title' => 'Создать нового пользователя',
                    'content' => $this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer' => Html::button('Закрыть', [
                        'class' => 'btn btn-default pull-left',
                        'data-dismiss' => 'modal'
                    ]) . Html::button('Сохранить', [
                        'class' => 'btn btn-primary',
                        'type' => 'submit'
                    ])

                ];
            } else if ($model->load($request->post()) && $model->save()) {
                return [
                    'forceReload' => '#crud-datatable-pjax',
                    'title' => 'Создать нового пользователя',
                    'content' => '<span class="text-success">Пользователь был успешно создан!</span>',
                    'footer' => Html::button('Закрыть', [
                        'class' => 'btn btn-default pull-left',
                        'data-dismiss' => 'modal'
                    ]) . Html::a('Создать еще', ['create'], [
                        'class' => 'btn btn-primary',
                        'role' => 'modal-remote'
                    ])
                ];
            } else {
                return [
                    'title' => 'Создать нового пользователя',
                    'content' => $this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer' => Html::button('Закрыть', [
                        'class' => 'btn btn-default pull-left',
                        'data-dismiss' => 'modal'
                    ]) . Html::button('Сохранить', [
                        'class' => 'btn btn-primary',
                        'type' => 'submit'
                    ])

                ];
            }
        } else {
            if ($model->load($request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        }
    }

    /**
     * Updates an existing User model.
     * For ajax request will return json object
     * and for non-ajax request if update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($id);

        if ($request->isAjax) {
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;

            if ($request->isGet) {
                return [
                    'title' => 'Изменить пользователя "' . $model->username . '"',
                    'content' => $this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer' => Html::button('Закрыть', [
                        'class' => 'btn btn-default pull-left',
                        'data-dismiss' => 'modal'
                    ]) . Html::button('Сохранить', [
                        'class' => 'btn btn-primary',
                        'type' => 'submit'
                    ])
                ];
            } else if ($model->load($request->post()) && $model->save()) {
                return [
                    'forceReload' => '#crud-datatable-pjax',
                    'title' => 'Пользователь "' . $model->username . '"',
                    'content' => $this->renderAjax('view', [
                        'model' => $model,
                    ]),
                    'footer' => Html::button('Закрыть', [
                        'class' => 'btn btn-default pull-left',
                        'data-dismiss' => 'modal'
                    ]) . Html::a('Править', ['update', 'id' => $id], [
                        'class' => 'btn btn-primary',
                        'role' => 'modal-remote'
                    ])
                ];
            } else {
                return [
                    'title' => 'Изменить пользователя "' . $model->username . '"',
                    'content' => $this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer' => Html::button('Закрыть', [
                        'class' => 'btn btn-default pull-left',
                        'data-dismiss' => 'modal'
                    ]) . Html::button('Сохранить', [
                        'class' => 'btn btn-primary',
                        'type' => 'submit'
                    ])
                ];
            }
        } else {
            if ($model->load($request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        }
    }

    public function actionDelete($id)
    {
        $request = Yii::$app->request;
        $this->findModel($id)->delete();

        if ($request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose' => true, 'forceReload' => '#crud-datatable-pjax'];
        } else {
            return $this->redirect(['index']);
        }
    }

    /**
     * Delete multiple existing User model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionBulkDelete()
    {
        $request = Yii::$app->request;

        $pks = explode(',', $request->post('pks'));
        foreach ($pks as $pk) {
            $model = $this->findModel($pk);
            $model->delete();
        }

        if ($request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose' => true, 'forceReload' => '#crud-datatable-pjax'];
        } else {
            return $this->redirect(['index']);
        }
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        $model = User::findOne($id);
        if ($model)
            return $model;

        throw new NotFoundHttpException('Запрашиваемая страница не существует.');
    }
    public function actionSetBan($id)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($id);
        $setBanForm = new SetBanForm($model);

        if (!$request->isAjax) {
            if ($request->isPost && $setBanForm->load($request->post()) && $setBanForm->save())
                return $this->redirect($request->referrer);

            return $this->redirect(['index']);
        }

        Yii::$app->response->format = Response::FORMAT_JSON;

        if ($request->isPost && $setBanForm->load($request->post())) {
            if (!$$setBanForm->save()) {
                Yii::$app->response->format = Response::FORMAT_JSON;

                return [
                    'forceReload' => '#crud-datatable-pjax',
                    'title' => 'Ошибка',
                    'content' => '<span class="text-error">' . BaseHtml::errorSummary($setBanForm) . '</span>',
                    'footer' => Html::button('Закрыть', [
                        'class' => 'btn btn-default pull-left',
                        'data-dismiss' => 'modal'
                    ]),
                ];
            } else {
                return ['forceClose' => true, 'forceReload' => '#crud-datatable-pjax'];
            }
        } else {
            return [
                'title' => 'Забанить',
                'content' => $this->renderAjax('setban', [
                    'setBanForm' => $setBanForm,
                ]),
                'footer' =>
                Html::button('Закрыть', [
                    'class' => 'btn btn-default pull-left',
                    'data-dismiss' => 'modal'
                ]) .
                    Html::button('Сохранить', [
                        'class' => 'btn btn-primary',
                        'type' => 'submit'
                    ])
            ];
        }
    }
}
