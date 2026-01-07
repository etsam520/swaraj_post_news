<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use App\Models\News;
use App\Models\NewsGallery;

class MigrateLocalImagesToS3 extends Command
{
    protected $signature = 'migrate:images-to-s3';
    protected $description = 'Move local news images and galleries from storage to S3 and remove local copies.';

    public function handle()
    {
        $this->info('📦 Migrating News Thumbnails...');
        $this->migrateNewsImageColumn('thumbnail');

        $this->info('📦 Migrating News Images...');
        $this->migrateNewsImageColumn('image');

        $this->info('📦 Migrating Gallery Images...');
        $this->migrateGalleryImages();

        $this->info('✅ Migration completed.');
    }

    private function migrateNewsImageColumn(string $column)
    {
        News::whereNotNull($column)->chunk(100, function ($newsItems) use ($column) {
            foreach ($newsItems as $news) {
                $relativePath = $news->$column;
                $localPath = 'public/' . $relativePath;

                if (Storage::exists($localPath)) {
                    $contents = Storage::get($localPath);

                    // Put to S3
                    Storage::disk('s3')->put($relativePath, $contents, 'public');

                    // Delete local file
                    Storage::delete($localPath);

                    $this->line("✔ Migrated & deleted: {$relativePath}");
                } else {
                    $this->warn("⚠ File not found: {$localPath}");
                }
            }
        });
    }

    private function migrateGalleryImages()
    {
        NewsGallery::whereNotNull('image_path')->chunk(100, function ($galleries) {
            foreach ($galleries as $gallery) {
                $relativePath = $gallery->image_path;
                $localPath = 'public/' . $relativePath;

                if (Storage::exists($localPath)) {
                    $contents = Storage::get($localPath);

                    // Put to S3
                    Storage::disk('s3')->put($relativePath, $contents, 'public');

                    // Delete local file
                    Storage::delete($localPath);

                    $this->line("✔ Migrated & deleted: {$relativePath}");
                } else {
                    $this->warn("⚠ File not found: {$localPath}");
                }
            }
        });
    }
}
