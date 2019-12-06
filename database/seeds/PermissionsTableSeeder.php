<?php

use App\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => '1',
                'title' => 'user_management_access',
            ],
            [
                'id'    => '2',
                'title' => 'permission_create',
            ],
            [
                'id'    => '3',
                'title' => 'permission_edit',
            ],
            [
                'id'    => '4',
                'title' => 'permission_show',
            ],
            [
                'id'    => '5',
                'title' => 'permission_delete',
            ],
            [
                'id'    => '6',
                'title' => 'permission_access',
            ],
            [
                'id'    => '7',
                'title' => 'role_create',
            ],
            [
                'id'    => '8',
                'title' => 'role_edit',
            ],
            [
                'id'    => '9',
                'title' => 'role_show',
            ],
            [
                'id'    => '10',
                'title' => 'role_delete',
            ],
            [
                'id'    => '11',
                'title' => 'role_access',
            ],
            [
                'id'    => '12',
                'title' => 'user_create',
            ],
            [
                'id'    => '13',
                'title' => 'user_edit',
            ],
            [
                'id'    => '14',
                'title' => 'user_show',
            ],
            [
                'id'    => '15',
                'title' => 'user_delete',
            ],
            [
                'id'    => '16',
                'title' => 'user_access',
            ],
            [
                'id'    => '17',
                'title' => 'service_category_create',
            ],
            [
                'id'    => '18',
                'title' => 'service_category_edit',
            ],
            [
                'id'    => '19',
                'title' => 'service_category_show',
            ],
            [
                'id'    => '20',
                'title' => 'service_category_delete',
            ],
            [
                'id'    => '21',
                'title' => 'service_category_access',
            ],
            [
                'id'    => '22',
                'title' => 'service_access',
            ],
            [
                'id'    => '23',
                'title' => 'facility_create',
            ],
            [
                'id'    => '24',
                'title' => 'facility_edit',
            ],
            [
                'id'    => '25',
                'title' => 'facility_show',
            ],
            [
                'id'    => '26',
                'title' => 'facility_delete',
            ],
            [
                'id'    => '27',
                'title' => 'facility_access',
            ],
            [
                'id'    => '28',
                'title' => 'sub_catagory_create',
            ],
            [
                'id'    => '29',
                'title' => 'sub_catagory_edit',
            ],
            [
                'id'    => '30',
                'title' => 'sub_catagory_show',
            ],
            [
                'id'    => '31',
                'title' => 'sub_catagory_delete',
            ],
            [
                'id'    => '32',
                'title' => 'sub_catagory_access',
            ],
            [
                'id'    => '33',
                'title' => 'area_create',
            ],
            [
                'id'    => '34',
                'title' => 'area_edit',
            ],
            [
                'id'    => '35',
                'title' => 'area_show',
            ],
            [
                'id'    => '36',
                'title' => 'area_delete',
            ],
            [
                'id'    => '37',
                'title' => 'area_access',
            ],
            [
                'id'    => '38',
                'title' => 'faq_management_access',
            ],
            [
                'id'    => '39',
                'title' => 'faq_category_create',
            ],
            [
                'id'    => '40',
                'title' => 'faq_category_edit',
            ],
            [
                'id'    => '41',
                'title' => 'faq_category_show',
            ],
            [
                'id'    => '42',
                'title' => 'faq_category_delete',
            ],
            [
                'id'    => '43',
                'title' => 'faq_category_access',
            ],
            [
                'id'    => '44',
                'title' => 'faq_question_create',
            ],
            [
                'id'    => '45',
                'title' => 'faq_question_edit',
            ],
            [
                'id'    => '46',
                'title' => 'faq_question_show',
            ],
            [
                'id'    => '47',
                'title' => 'faq_question_delete',
            ],
            [
                'id'    => '48',
                'title' => 'faq_question_access',
            ],
            [
                'id'    => '49',
                'title' => 'sub_service_create',
            ],
            [
                'id'    => '50',
                'title' => 'sub_service_edit',
            ],
            [
                'id'    => '51',
                'title' => 'sub_service_show',
            ],
            [
                'id'    => '52',
                'title' => 'sub_service_delete',
            ],
            [
                'id'    => '53',
                'title' => 'sub_service_access',
            ],
            [
                'id'    => '54',
                'title' => 'feedback_access',
            ],
            [
                'id'    => '55',
                'title' => 'order_access',
            ],
        ];

        Permission::insert($permissions);
    }
}
