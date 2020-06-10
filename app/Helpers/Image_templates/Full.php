<?php
namespace App\Helpers\Image_templates;
use Intervention\Image\Image;
use Intervention\Image\Filters\FilterInterface;

class Full implements FilterInterface
{

    public function applyFilter(Image $image)
    {
        return $image->fit(40, 40);
    }
}

?>