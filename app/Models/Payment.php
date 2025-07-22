<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'membership_id',
        'amount',
        'payment_type',
        'payment_method',
        'payment_date',
        'due_date',
        'status',
        'reference_number',
        'notes',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'payment_date' => 'date',
        'due_date' => 'date',
    ];

    // Payment Types
    const TYPE_REGISTRATION = 'registration';
    const TYPE_MONTHLY = 'monthly';
    const TYPE_RENEWAL = 'renewal';
    const TYPE_LATE_FEE = 'late_fee';

    // Payment Methods
    const METHOD_CASH = 'cash';
    const METHOD_CARD = 'card';
    const METHOD_BANK_TRANSFER = 'bank_transfer';
    const METHOD_MOBILE_MONEY = 'mobile_money';

    // Payment Status
    const STATUS_PENDING = 'pending';
    const STATUS_COMPLETED = 'paid'; // Database uses 'paid' but we keep the constant name
    const STATUS_PAID = 'paid';
    const STATUS_OVERDUE = 'overdue';
    const STATUS_CANCELLED = 'cancelled';

    public static function getTypes()
    {
        return [
            self::TYPE_REGISTRATION => 'Registration Fee',
            self::TYPE_MONTHLY => 'Monthly Fee',
            self::TYPE_RENEWAL => 'Renewal Fee',
            self::TYPE_LATE_FEE => 'Late Fee',
        ];
    }

    public static function getMethods()
    {
        return [
            self::METHOD_CASH => 'Cash',
            self::METHOD_CARD => 'Card',
            self::METHOD_BANK_TRANSFER => 'Bank Transfer',
            self::METHOD_MOBILE_MONEY => 'Mobile Money',
        ];
    }

    public static function getStatuses()
    {
        return [
            self::STATUS_PENDING => 'Pending',
            self::STATUS_PAID => 'Paid',
            self::STATUS_OVERDUE => 'Overdue',
            self::STATUS_CANCELLED => 'Cancelled',
        ];
    }

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function membership()
    {
        return $this->belongsTo(Membership::class);
    }
}
