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
        $admin = User::create([
            'name' => 'DomDrills Admin',
            'email' => 'admin@domdrills.com',
            'login_id' => 'admin101',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);
 
        // 2. Seed default student user
        $student = User::create([
            'name' => 'John Doe',
            'email' => 'student@domdrills.com',
            'login_id' => 'student101',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'role' => 'student',
        ]);

        // 3. Seed membership plans
        $monthly = MembershipPlan::create([
            'name' => 'Monthly Plan',
            'slug' => 'monthly',
            'price' => 1999.00,
            'billing_period' => 'monthly',
            'description' => 'Perfect for testing the waters and learning fundamentals.',
            'features' => ['All Recorded Courses', 'Live Trading Sessions', 'Premium Trading Tools', 'Private Dashboard', 'Community Access'],
        ]);

        $quarterly = MembershipPlan::create([
            'name' => 'Quarterly Plan',
            'slug' => 'quarterly',
            'price' => 4999.00,
            'billing_period' => 'quarterly',
            'description' => 'Our most popular tier. Gives you time to practice.',
            'features' => ['All Recorded Courses', 'Live Trading Sessions', 'Premium Trading Tools', 'Private Dashboard', 'Community Access', 'Priority Support'],
        ]);

        $yearly = MembershipPlan::create([
            'name' => 'Yearly Plan',
            'slug' => 'yearly',
            'price' => 14999.00,
            'billing_period' => 'yearly',
            'description' => 'The complete package for serious long-term traders.',
            'features' => ['All Recorded Courses', 'Live Trading Sessions', 'Premium Trading Tools', 'Private Dashboard', 'Community Access', 'Priority Support', 'Exclusive Workshops'],
        ]);

        // 4. Attach active quarterly membership to student
        Membership::create([
            'user_id' => $student->id,
            'membership_plan_id' => $quarterly->id,
            'status' => 'active',
            'expires_at' => now()->addMonths(3),
        ]);

        // 5. Seed educational courses
        $course1 = Course::create([
            'title' => 'Order Flow & Microstructure Fundamentals',
            'slug' => 'order-flow-fundamentals',
            'description' => 'Learn how institutional market orders interact with the limit order book, and understand the core mechanics of auction market theory.',
            'image_path' => null,
            'published' => true,
            'order' => 1,
        ]);

        $module1 = Module::create([
            'course_id' => $course1->id,
            'title' => 'Market Depth & Order Book Dynamics',
            'description' => 'Fundamentals of order book matching algorithms, limit orders, market orders, and the depth of market (DOM).',
            'order' => 1,
        ]);

        $lesson1 = Lesson::create([
            'module_id' => $module1->id,
            'title' => 'Market Orders vs Limit Orders',
            'slug' => 'market-limit-orders',
            'description' => 'Deep dive into passive vs aggressive orders, liquidity creation vs consumption, and slippage calculations.',
            'content' => 'In this lesson, we break down how market orders consume existing liquidity in the order book. Limit orders act as the liquidity provider, whereas market orders act as the liquidity taker. Understanding this relationship is crucial for deciphering footprints and Cumulative Delta.',
            'order' => 1,
            'duration_minutes' => 20,
        ]);

        $lesson2 = Lesson::create([
            'module_id' => $module1->id,
            'title' => 'Understanding the DOM (Depth of Market)',
            'slug' => 'understanding-dom',
            'description' => 'How to read bids and asks, tracking spoofing and iceberg orders, and understanding order queues.',
            'content' => 'The Depth of Market (DOM) displays the electronic limit order book queue. We explore how professional traders identify real liquidity versus fake liquidity (spoofing) and monitor institutional accumulation/distribution via iceberg orders.',
            'order' => 2,
            'duration_minutes' => 30,
        ]);

        // Attach sample videos to lessons
        Video::create([
            'lesson_id' => $lesson1->id,
            'provider' => 'local',
            'video_id' => 'sample1',
            'video_path' => 'courses/videos/sample.mp4',
            'duration' => 1200,
            'size' => 15000000,
        ]);

        Video::create([
            'lesson_id' => $lesson2->id,
            'provider' => 'local',
            'video_id' => 'sample2',
            'video_path' => 'courses/videos/sample.mp4',
            'duration' => 1800,
            'size' => 22000000,
        ]);

        $course2 = Course::create([
            'title' => 'Footprint Charts & Volume Profile Execution',
            'slug' => 'footprint-volume-profile',
            'description' => 'Master bid/ask imbalance tracking, delta divergence patterns, and using volume profiles to locate high-probability execution nodes.',
            'image_path' => null,
            'published' => true,
            'order' => 2,
        ]);

        $module2 = Module::create([
            'course_id' => $course2->id,
            'title' => 'Footprint Chart Analysis',
            'description' => 'Interpreting footprint charts, imbalance ratios, and cumulative delta divergence.',
            'order' => 1,
        ]);

        $lesson3 = Lesson::create([
            'module_id' => $module2->id,
            'title' => 'Imbalances & Delta Divergence',
            'slug' => 'imbalances-delta-divergence',
            'description' => 'How to identify aggressive buyers/sellers and potential reversal zones using footprint imbalances.',
            'content' => 'Footprint charts reveal the exact volume traded at the bid and ask for each price level. This lesson teaches you how to identify buying/selling imbalances (usually diagonal comparison ratios like 300%+) and spots cumulative delta divergence at key support/resistance areas.',
            'order' => 1,
            'duration_minutes' => 35,
        ]);

        Video::create([
            'lesson_id' => $lesson3->id,
            'provider' => 'local',
            'video_id' => 'sample3',
            'video_path' => 'courses/videos/sample.mp4',
            'duration' => 2100,
            'size' => 28000000,
        ]);

        // 6. Seed live sessions
        LiveSession::create([
            'title' => 'Nifty Live Order Flow Analysis & Execution',
            'slug' => 'nifty-live-order-flow',
            'description' => 'Live market session focusing on depth of market absorption, order book imbalance, and footprint execution during the opening auction.',
            'scheduled_at' => now()->addDays(2)->setTime(9, 15, 0),
            'duration_minutes' => 90,
            'meeting_link' => 'https://zoom.us/j/987654321',
            'recording_path' => null,
            'status' => 'scheduled',
        ]);

        LiveSession::create([
            'title' => 'Bank Nifty Post-Market Recap & Auction Review',
            'slug' => 'bank-nifty-post-market',
            'description' => 'A complete walk-through of the daily auction profiles. We analyze POC development, value area migrations, and key absorption signatures.',
            'scheduled_at' => now()->subDays(3)->setTime(16, 30, 0),
            'duration_minutes' => 60,
            'meeting_link' => null,
            'recording_path' => 'sessions/recordings/sample.mp4',
            'status' => 'completed',
        ]);
    }
}
