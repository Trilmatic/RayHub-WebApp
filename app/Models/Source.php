<?php

namespace App\Models;

use Hashids\Hashids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Source extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = ['hash', 'path', 'source_type', 'content_type', 'ip', 'user_id'];

    protected static function boot()
    {
        parent::boot();
        static::created(function ($record) {
            $hashids = new Hashids(env('SOURCE_HASH_KEY', 1), 8);
            $hash = $hashids->encode($record->id);
            activity()->withoutLogs(function () use ($record, $hash) {
                DB::transaction(callback: static fn () => $record->update(
                    [
                        'hash' => $hash,
                    ]
                ), attempts: 2,);
            });
        });
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['path', 'type', 'ip'])->dontSubmitEmptyLogs();
    }

    public function files()
    {
        return $this->hasMany(SourceFile::class);
    }

    public function videos()
    {
        return $this->hasMany(SourceFile::class)->where('is_video', true);
    }

    public function other_files()
    {
        return $this->hasMany(SourceFile::class)->where('is_video', false);
    }
}
