<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function bookings(){
        return $this->belongsToMany(Booking::class);
    }
    
    public function booking_users(){
        return $this->hasMany(BookingUser::class, 'user_id', 'id');
    }

    public function scopeNotInvited($query, $booking_id){
        return $query->whereDoesntHave('booking_users', function($query) use($booking_id){
            $query->where('booking_id', $booking_id);
        });
    }
    
    public function groups(){
        return $this->belongsToMany(Group::class)->wherePivot('status', 'joined');
    }

    public function bookingX($booking_id){
        return $this->belongsToMany(Booking::class)->wherePivot('booking_id', '=', $booking_id)->first();
    }

    public function bookingUsers(){
        return $this->hasMany(BookingUser::class, 'user_id', 'id');
    }

    public function pivots(){
        return $this->hasMany(BookingUser::class, 'user_id', 'id');
    }
    
    public function pivotAtBookingX(){
        return $this->hasOne(BookingUser::class, 'user_id', 'id');
    }
    
//    public function scopeIsMember($query, $adminid){
//        return $query->where('id', '!='. $adminid);
//    }
    public function scopeNotAdmin($query, $admin_id){
        return $query->where('users.id', '!=', $admin_id);
    }
    
//    public function scopeAddGroupStatus($query){
//        return $query->withPivot('status');
//    }
//    public function relatedBookings(){}
    public function verifyBookings(){
        return $this->hasMany(Booking::class, 'created_by', 'id');
    }
}
