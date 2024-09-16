<?php

namespace Modules\Accounts\Entities;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProvidentFund extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id','type',
        'employee_share_amount',
        'org_share_amount','employee_share_percent',
        'org_share_percent','description'
    ];

    public function employee(){
        return $this->belongsTo(Employee::class);
    }

    protected static function newFactory()
    {
        return \Modules\Accounts\Database\factories\ProvidentFundFactory::new();
    }
}
