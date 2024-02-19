<?php

namespace App\Models;

use CodeIgniter\Model;

class UserCategoriesModel extends Model
{
    protected $table = 'user_categories';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id', 'user_id', 'category_id'];
    public function storeUserCategories($userId, $selectedCategories)
    {
        // Delete existing entries for the user
        $this->where('user_id', $userId)->delete();

        // Insert the selected categories
        foreach ($selectedCategories as $categoryId) {
            $data = [
                'user_id' => $userId,
                'category_id' => $categoryId,
            ];
            $this->insert($data);
        }
    }

}
