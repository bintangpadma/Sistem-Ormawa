<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $guarded = ['id'];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function admin(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'admins_id', 'id');
    }

    public function student_organization(): BelongsTo
    {
        return $this->belongsTo(StudentOrganization::class, 'student_organizations_id', 'id');
    }

    public function student_activity_unit(): BelongsTo
    {
        return $this->belongsTo(StudentActivityUnit::class, 'student_activity_units_id', 'id');
    }

    public function getFullNameAttribute()
    {
        if ($this->load('admin')->admin) {
            return $this->load('admin')->admin->full_name;
        } else if ($this->load('student_organization')) {
            return $this->load('student_organization')->student_organization->name;
        } else if ($this->load('student_activity_unit')) {
            return $this->load('student_activity_unit')->student_activity_unit->name;
        } else {
            return 'User';
        }
    }

    public function getProfilePathAttribute(): string
    {
        if ($this->relationLoaded('admin') && $this->admin && $this->admin->profile_path) {
            return asset('assets/image/admin/' . $this->admin->profile_path);
        } else if ($this->relationLoaded('student_organization') && $this->student_organization && $this->student_organization->image_path) {
            return asset('assets/image/student-organization/' . $this->student_organization->image_path);
        } else if ($this->relationLoaded('student_activity_unit') && $this->student_activity_unit && $this->student_activity_unit->image_path) {
            return asset('assets/image/student-activity-unit/' . $this->student_activity_unit->image_path);
        } else {
            return 'https://placehold.co/48x48?text=Image+Not+Found';
        }
    }
}
