<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class Message extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $fillable = ['user_id', 'answer_message_id', 'message', 'filename'];

    /**
     * Validate rules for creating message
     *
     * @var array
     */
    public static $createValidateRules = [
        'message'           => 'required|max:1000',
        'answer_message_id' => 'integer',
        'image'             => 'image|dimensions:min_width=100,min_height=100,max_width=500,max_height=500',
    ];

    /**
     * Folder of images
     *
     * @var string
     */
    public static $imagesFolder = 'guestbook/';

    /**
     * User Relation
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user() {
        return $this->hasOne('App\User', 'id', 'user_id');
    }

    /**
     * Message Relation
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function answers() {
        return $this->hasMany('App\Message', 'answer_message_id', 'id');
    }

    public function getImage() {
        $filePath = Storage::url(self::$imagesFolder.$this->filename);

        return $filePath;
    }

    public static function add($request, $params = []) {
        $data = $request->all();

        if (count($params) > 0) {
            foreach ($params as $param => $value) {
                $data[$param] = $value;
            }
        }

        $message = Message::create($data);

        if ($request->hasFile('image')) {
            $image = $request->file('image');

            $filename = $message->id.'.'.$image->extension();

            if ($image->storeAs(Message::$imagesFolder, $filename, 'public')) {
                $message->update([
                    'filename' => $filename
                ]);
            }
        }
    }

    public static function boot() {
        parent::boot();

        //while creating/inserting item into db
        static::creating(function (Message $message) {
            if (Auth::user()) {
                $message->user_id = Auth::user()->id;
            }
        });
    }
}
