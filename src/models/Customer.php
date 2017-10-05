<?php

namespace Nikolag\Square\Models;

use Nikolag\Core\Models\Customer as CoreCustomer;
use Nikolag\Square\Utils\Constants;

class Customer extends CoreCustomer
{
    /**
     * The model's attributes.
     *
     * @var array
     */
    protected $attributes = [
        'payment_service_type' => 'square'
    ];

    /**
     * List of users this customer bought from.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function merchants()
    {
        return $this->belongsToMany(config('nikolag.connections.square.user.namespace'), 'nikolag_customer_user', 'customer_id', 'owner_id');
    }

    /**
     * List of previous transactions.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function transactions()
    {
        return $this->hasMany(Constants::TRANSACTION_NAMESPACE, 'customer_id', Constants::CUSTOMER_IDENTIFIER);
    }
}
