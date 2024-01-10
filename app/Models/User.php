<?php
namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Delivery;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'users'; // Veritabanındaki tablo adını belirtin
    protected $primaryKey = 'id'; // Primary key'i belirtin (varsayılan olarak 'id')

  // User modelindeki ilişkiler
  public function deliveries() {
    return $this->hasMany(Delivery::class, 'user_id');
  }

  public function books() {
    return $this->hasManyThrough(Book::class, Delivery::class, 'user_id', 'id', 'id', 'book_id');
  }
  public function active() {
    return $this->hasManyThrough(Book::class, Delivery::class, 'user_id', 'id', 'id', 'book_id')->where('status', 'false');
  }
    public function delivery(): HasMany {
        return $this->hasMany(Delivery::class, 'user_id', 'id');
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['name', 'surname', 'tel', 'address', 'email', 'password'];

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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}

