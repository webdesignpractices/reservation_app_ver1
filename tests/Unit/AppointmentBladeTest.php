<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Http\Controllers\Appointment;
use App\Http\Controllers\Auth;
use App\Models\User;
use App\Models\Service;
use App\Models\Staff;

class AppointmentBladeTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_example(): void
    {
        $this->assertTrue(true);
    }
        class AppointmentBladeTest extends TestCase
{
    /** @test */
    public function AppointmentBladeTest()
    {
        $user = new User(['id' => 1, 'name' => 'テストユーザー']);

        // 2. ログイン状態にする（これだけでログインした扱いになります）
        $this->actingAs($user);
        
        // 1. テスト用のダミーデータ（モックオブジェクト）を作成
        $service = (object) ['name' => 'カット'];
        $appointment = (object) ['services' => $service];

        // 2. テストしたいBladeの1行を実行
        $html = $this->blade('<span>メニュー：{{ $appointment->services->name }}</span><br>', [
            'appointment' => $appointment
        ]);

        // 3. 期待通りのHTMLが出力されたか検証
        $html->assertSee('<span>メニュー：カット</span><br>', false);
    }
}
}
