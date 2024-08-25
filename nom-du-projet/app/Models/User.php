<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\StoreKeeper;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $primaryKey = "user_id";


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'name',
        'email',
        'password',
        "role",
        'type',
    ];
    public function isStoreKeeper()
    {
        return $this->type === 'store_keeper';
    }

    public function isAdmin()
    {
        return $this->type === 'admin';
    }

    public function isAgent()
    {
        return $this->type === 'agent';
    }




    public function storeKeeper()
    {
        return $this->hasOne(StoreKeeper::class);
    }

    // Relation avec Admin
  /*   public function admin()
    {
        return $this->hasOne(Admin::class);
    } */

    // Relation avec Agent
   /*  public function agent()
    {
        return $this->hasOne(Agent::class);
    } */






    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
