<?php

namespace App\Models;

use Hashids\Hashids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class SourceFile extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = ['hash', 'name', 'path', 'type', 'source_id', 'is_video', 'user_id'];

    protected static function boot()
    {
        parent::boot();
        static::created(function ($record) {
            $hashids = new Hashids(env('SOURCE_FILE_HASH_KEY', 1), 8);
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
            ->logOnly(['path', 'name', 'type'])->dontSubmitEmptyLogs();
    }
}
