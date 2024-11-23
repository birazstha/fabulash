<?php

namespace Database\Seeders;

use App\Models\EmailTemplate;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class EmailTemplateSeeder extends Seeder
{
    protected $model;

    public function __construct(EmailTemplate $model)
    {
        $this->model = $model;
    }

    public function run()
    {
        $this->model->truncate();

        $contentTypes = [
            [
                'subject' => 'Welcome to the Team!',
                'code' => 'WelcomeNewEmployee',
                'content' => '<p>Dear %name%,</p><p>We are pleased to welcome you to the <strong>%company_name% </strong>team. Your skills and experience will be a valuable addition to our organization, and we look forward to achieving great success together.</p><p>We have created your account in our system. Below are your login credentials:</p><p><strong>Username:</strong> %username%</p><p><strong>Password:</strong> %password%</p><p>For security purposes, please be sure to change your password upon your first login.</p><p>To access the system, please click this <a href="%link% ">link</a> to start your session.</p><p>Once again, welcome to the team. We are excited to have you on board and look forward to a productive and successful collaboration.</p><p>Best Regards,<br>%company_name%</p>',
                'rank' => 1,
                'status' => true
            ],
            [
                'subject' => 'Reset Password',
                'code' => 'ResetPassword',
                'content' => '<p>Dear %name%,</p><p>Here is your <a href="%link%">link</a> for resetting your password.</p><p>Regards,<br>%company_name%</p>',
                'rank' => 2,
                'status' => true
            ],
        ];

        foreach ($contentTypes as $type) {
            $this->model->updateOrInsert(
                ['code' => $type['code']],
                [
                    'subject' => $type['subject'] ?? null,
                    'from' => $type['from'] ?? null,
                    'code' => $type['code'] ?? null,
                    'content' => $type['content'] ?? null,
                    'status' => $type['status'] ?? null,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]
            );
        }
    }
}
