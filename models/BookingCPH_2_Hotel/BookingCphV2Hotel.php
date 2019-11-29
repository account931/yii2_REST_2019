<?php

namespace app\models\BookingCPH_2_Hotel;

use Yii;

/**
 * This is the model class for table "booking_cph_v2_hotel".
 *
 * @property int $book_id
 * @property string $booked_by_user
 * @property string $booked_guest
 * @property string $booked_guest_email
 * @property string $book_from
 * @property string $book_to
 * @property int $book_from_unix
 * @property int $book_to_unix
 * @property int $book_room_id
 */
class BookingCphV2Hotel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'booking_cph_v2_hotel';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['booked_by_user', 'booked_guest', 'booked_guest_email', 'book_from', 'book_to', 'book_from_unix', 'book_to_unix', 'book_room_id'], 'required'],
            [['book_from_unix', 'book_to_unix', 'book_room_id'], 'integer'],
            [['booked_by_user', 'booked_guest', 'booked_guest_email'], 'string', 'max' => 77],
            [['book_from', 'book_to'], 'string', 'max' => 33],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'book_id' => Yii::t('app', 'Book ID'),
            'booked_by_user' => Yii::t('app', 'Booked By User'),
            'booked_guest' => Yii::t('app', 'Booked Guest'),
            'booked_guest_email' => Yii::t('app', 'Booked Guest Email'),
            'book_from' => Yii::t('app', 'Book From'),
            'book_to' => Yii::t('app', 'Book To'),
            'book_from_unix' => Yii::t('app', 'Book From Unix'),
            'book_to_unix' => Yii::t('app', 'Book To Unix'),
            'book_room_id' => Yii::t('app', 'Book Room ID'),
        ];
    }
}
