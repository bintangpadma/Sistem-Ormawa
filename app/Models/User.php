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
        $this->loadMissing(['admin', 'student_activity_unit', 'student_organization']);

        if ($this->admin) {
            return $this->admin->full_name;
        }

        if ($this->student_organization) {
            return $this->student_organization->name;
        }

        if ($this->student_activity_unit) {
            return $this->student_activity_unit->name;
        }

        return 'User';
    }

    public function getProfilePathAttribute(): string
    {
        $this->loadMissing(['admin', 'student_activity_unit', 'student_organization']);

        if ($this->admin?->profile_path) {
            return asset('assets/image/admin/' . $this->admin->profile_path);
        }

        if ($this->student_organization?->image_path) {
            return asset('assets/image/student-organization/' . $this->student_organization->image_path);
        }

        if ($this->student_activity_unit?->image_path) {
            return asset('assets/image/student-activity-unit/' . $this->student_activity_unit->image_path);
        }

        return 'https://placehold.co/48x48?text=Image+Not+Found';
    }
}
