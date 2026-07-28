<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Lesson;
use App\Models\LiveSession;
use App\Models\Membership;
use App\Models\MembershipPlan;
use App\Models\Module;
use App\Models\User;
use App\Models\Video;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Seed admin user
        $admin = User::firstOrCreate(
            ['email' => 'admin@domdrills.com'],
            [
                'name' => 'DomDrills Admin',
                'login_id' => 'admin101',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'role' => 'admin',
            ]
        );
 
        // 2. Seed default student user
        $student = User::firstOrCreate(
            ['email' => 'student@domdrills.com'],
            [
                'name' => 'John Doe',
                'login_id' => 'student101',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'role' => 'student',
            ]
        );

        // 3. Seed membership plans
        $monthly = MembershipPlan::firstOrCreate(
            ['slug' => 'monthly'],
            [
                'name' => 'Monthly Plan',
                'price' => 1999.00,
                'billing_period' => 'monthly',
                'description' => 'Perfect for testing the waters and learning fundamentals.',
                'features' => ['All Recorded Courses', 'Live Trading Sessions', 'Premium Trading Tools', 'Private Dashboard', 'Community Access'],
            ]
        );

        $quarterly = MembershipPlan::firstOrCreate(
            ['slug' => 'quarterly'],
            [
                'name' => 'Quarterly Plan',
                'price' => 4999.00,
                'billing_period' => 'quarterly',
                'description' => 'Our most popular tier. Gives you time to practice.',
                'features' => ['All Recorded Courses', 'Live Trading Sessions', 'Premium Trading Tools', 'Private Dashboard', 'Community Access', 'Priority Support'],
            ]
        );

        $yearly = MembershipPlan::firstOrCreate(
            ['slug' => 'yearly'],
            [
                'name' => 'Yearly Plan',
                'price' => 14999.00,
                'billing_period' => 'yearly',
                'description' => 'The complete package for serious long-term traders.',
                'features' => ['All Recorded Courses', 'Live Trading Sessions', 'Premium Trading Tools', 'Private Dashboard', 'Community Access', 'Priority Support', 'Exclusive Workshops'],
            ]
        );

        // 4. Attach active quarterly membership to student if not exists
        if (!$student->memberships()->exists()) {
            Membership::create([
                'user_id' => $student->id,
                'membership_plan_id' => $quarterly->id,
                'status' => 'active',
                'expires_at' => now()->addMonths(3),
            ]);
        }

        // 5. Seed educational courses
        $course1 = Course::firstOrCreate(
            ['slug' => 'order-flow-fundamentals'],
            [
                'title' => 'Order Flow & Microstructure Fundamentals',
                'description' => 'Learn how institutional market orders interact with the limit order book, and understand the core mechanics of auction market theory.',
                'image_path' => null,
                'published' => true,
                'order' => 1,
            ]
        );

        $module1 = Module::firstOrCreate(
            ['course_id' => $course1->id, 'title' => 'Market Depth & Order Book Dynamics'],
            [
                'description' => 'Fundamentals of order book matching algorithms, limit orders, market orders, and the depth of market (DOM).',
                'order' => 1,
            ]
        );

        $lesson1 = Lesson::firstOrCreate(
            ['slug' => 'market-limit-orders'],
            [
                'module_id' => $module1->id,
                'title' => 'Market Orders vs Limit Orders',
                'description' => 'Deep dive into passive vs aggressive orders, liquidity creation vs consumption, and slippage calculations.',
                'content' => 'In this lesson, we break down how market orders consume existing liquidity in the order book. Limit orders act as the liquidity provider, whereas market orders act as the liquidity taker. Understanding this relationship is crucial for deciphering footprints and Cumulative Delta.',
                'order' => 1,
                'duration_minutes' => 20,
            ]
        );

        $lesson2 = Lesson::firstOrCreate(
            ['slug' => 'understanding-dom'],
            [
                'module_id' => $module1->id,
                'title' => 'Understanding the DOM (Depth of Market)',
                'description' => 'How to read bids and asks, tracking spoofing and iceberg orders, and understanding order queues.',
                'content' => 'The Depth of Market (DOM) displays the electronic limit order book queue. We explore how professional traders identify real liquidity versus fake liquidity (spoofing) and monitor institutional accumulation/distribution via iceberg orders.',
                'order' => 2,
                'duration_minutes' => 30,
            ]
        );

        // Attach sample videos to lessons if not exists
        Video::firstOrCreate(
            ['lesson_id' => $lesson1->id, 'video_id' => 'sample1'],
            [
                'provider' => 'local',
                'video_path' => 'courses/videos/sample.mp4',
                'duration' => 1200,
                'size' => 15000000,
            ]
        );

        Video::firstOrCreate(
            ['lesson_id' => $lesson2->id, 'video_id' => 'sample2'],
            [
                'provider' => 'local',
                'video_path' => 'courses/videos/sample.mp4',
                'duration' => 1800,
                'size' => 22000000,
            ]
        );

        $course2 = Course::firstOrCreate(
            ['slug' => 'footprint-volume-profile'],
            [
                'title' => 'Footprint Charts & Volume Profile Execution',
                'description' => 'Master bid/ask imbalance tracking, delta divergence patterns, and using volume profiles to locate high-probability execution nodes.',
                'image_path' => null,
                'published' => true,
                'order' => 2,
            ]
        );

        $module2 = Module::firstOrCreate(
            ['course_id' => $course2->id, 'title' => 'Footprint Chart Analysis'],
            [
                'description' => 'Interpreting footprint charts, imbalance ratios, and cumulative delta divergence.',
                'order' => 1,
            ]
        );

        $lesson3 = Lesson::firstOrCreate(
            ['slug' => 'imbalances-delta-divergence'],
            [
                'module_id' => $module2->id,
                'title' => 'Imbalances & Delta Divergence',
                'description' => 'How to identify aggressive buyers/sellers and potential reversal zones using footprint imbalances.',
                'content' => 'Footprint charts reveal the exact volume traded at the bid and ask for each price level. This lesson teaches you how to identify buying/selling imbalances (usually diagonal comparison ratios like 300%+) and spots cumulative delta divergence at key support/resistance areas.',
                'order' => 1,
                'duration_minutes' => 35,
            ]
        );

        Video::firstOrCreate(
            ['lesson_id' => $lesson3->id, 'video_id' => 'sample3'],
            [
                'provider' => 'local',
                'video_path' => 'courses/videos/sample.mp4',
                'duration' => 2100,
                'size' => 28000000,
            ]
        );

        // 6. Seed live sessions
        LiveSession::firstOrCreate(
            ['slug' => 'nifty-live-order-flow'],
            [
                'title' => 'Nifty Live Order Flow Analysis & Execution',
                'description' => 'Live market session focusing on depth of market absorption, order book imbalance, and footprint execution during the opening auction.',
                'scheduled_at' => now()->addDays(2)->setTime(9, 15, 0),
                'duration_minutes' => 90,
                'meeting_link' => 'https://zoom.us/j/987654321',
                'recording_path' => null,
                'status' => 'scheduled',
            ]
        );

        LiveSession::firstOrCreate(
            ['slug' => 'bank-nifty-post-market'],
            [
                'title' => 'Bank Nifty Post-Market Recap & Auction Review',
                'description' => 'A complete walk-through of the daily auction profiles. We analyze POC development, value area migrations, and key absorption signatures.',
                'scheduled_at' => now()->subDays(3)->setTime(16, 30, 0),
                'duration_minutes' => 60,
                'meeting_link' => null,
                'recording_path' => 'sessions/recordings/sample.mp4',
                'status' => 'completed',
            ]
        );
    }
}
