<?php

namespace App\Repositories;

use Ramsey\Uuid\Uuid;
use App\Models\Subscription;

class SubscriptionRepository
{
    public function getAllSubscriptions()
    {
        return Subscription::orderBy('created_at', 'ASC')->get();
    }

    public function getAllSubscriptionsWithoutStarter()
    {
        return Subscription::where('name', '!=', 'Starter')->orderBy('created_at', 'ASC')->get();
    }

    public function getAllSubscriptionsWithoutStarterOrderByMonthDuration()
    {
        return Subscription::where('name', '!=', 'Starter')->orderBy('month_duration', 'ASC')->get();
    }

    public function getSubscriptionByName($name)
    {
        return Subscription::where('name', $name)->first();
    }

    public function getSubscription($id)
    {
        return Subscription::find($id);
    }

    public function createSubscription($data)
    {
        return Subscription::create([
            'id' => Uuid::uuid4()->toString(),
            'name' => $data['name'],
            'month_duration' => $data['month_duration']
        ]);
    }

    public function updateSubscription($data, $id)
    {
        return self::getSubscription($id)->update([
            'name' => $data['name'],
            'month_duration' => $data['month_duration'] ?? 1
        ]);
    }

    public function deleteSubscription($id)
    {
        return self::getSubscription($id)->delete();
    }
}