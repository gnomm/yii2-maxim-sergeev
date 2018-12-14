<?php

namespace console\controllers;

use yii\console\Controller;

class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = \Yii::$app->authManager;

        $auth->removeAll();

        // Создадание ролей
        $admin = $auth->createRole('admin');
        $admin->description = 'Администратор';

        $adminProject = $auth->createRole('adminProject');
        $adminProject->description = 'Администратор проекта';

        $user = $auth->createRole('user');
        $user->description = 'Пользователь';

//        $guest = $auth->createRole('guest');


        // запишем их в БД
        $auth->add($admin);
        $auth->add($adminProject);
        $auth->add($user);
//        $auth->add($guest);


        // Создаем разрешения
        $viewAdminPage = $auth->createPermission('viewAdminPage');
        $viewAdminPage->description = 'Просмотр админки';

        $updateProject = $auth->createPermission('updateProject');
        $updateProject->description = 'Редактирование проекта';

        $updateTask = $auth->createPermission('updateTask');
        $updateTask->description = 'Редактирование задач';


        // Запишем эти разрешения в БД
        $auth->add($viewAdminPage);
        $auth->add($updateProject);
        $auth->add($updateTask);


        // Роли adminProject присваиваем разрешение «Редактировать проекты»
        $auth->addChild($adminProject, $updateProject);

        // Роли adminProject присваиваем разрешение «Редактировать задач»
        $auth->addChild($adminProject, $updateTask);

        // Роли user присваиваем разрешение «Редактировать проекты»
        $auth->addChild($user, $updateTask);

        // админ наследует роль редактора новостей. Он же админ, должен уметь всё! :D
        $auth->addChild($admin, $adminProject);

        // Еще админ имеет собственное разрешение - «Просмотр админки»
        $auth->addChild($admin, $viewAdminPage);

        // Назначаем роль admin пользователю с ID 1
        $auth->assign($admin, 1);

//        // Назначаем роль adminProject пользователю с ID 2
//        $auth->assign($adminProject, 2);
//
//        // Назначаем роль user пользователю с ID 3
//        $auth->assign($user, 3);

    }
}