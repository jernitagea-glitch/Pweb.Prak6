 <?php
$imageDataUri = null;
if (!empty($newsItem['image'])) {
    $imagePath = __DIR__ . '/../../uploads/' . $newsItem['image'];
    if (file_exists($imagePath) && is_file($imagePath)) {
        $mimeType = mime_content_type($imagePath) ?: 'image/jpeg';
        $imageDataUri = 'data:' . $mimeType . ';base64,' . base64_encode(file_get_contents($imagePath));
    }
}

$tanggalTampil = !empty($newsItem['created_at'])
    ? date('d F Y, H:i', strtotime($newsItem['created_at'])) . ' WIB'
    : '-';
?>
 <!DOCTYPE html>
 <html lang="id">

 <head>
     <meta charset="UTF-8">
     <title><?= htmlspecialchars($newsItem['title']) ?></title>
     <style>
     @page {
         margin: 22mm 20mm;
     }

     body {
         font-family: "DejaVu Sans", sans-serif;
         font-size: 11pt;
         line-height: 1.6;
         color: #212529;
     }

     .brand {
         font-size: 9pt;
         color: #6c757d;
         text-transform: uppercase;
         letter-spacing: 1px;
         margin-bottom: 10px;
     }

     .header {
         border-bottom: 2px solid #dee2e6;
         padding-bottom: 14px;
         margin-bottom: 18px;
     }

     .badge {
         display: inline-block;
         background-color: #e7f1ff;
         color: #0d6efd;
         border: 1px solid #b6d4fe;
         padding: 3px 10px;
         font-size: 9pt;
         font-weight: bold;
         border-radius: 4px;
         margin-bottom: 10px;
     }

     h1 {
         font-size: 18pt;
         line-height: 1.3;
         margin: 6px 0 10px 0;
         color: #111827;
     }

     .meta {
         font-size: 9.5pt;
         color: #6c757d;
     }

     .image-wrapper {
         text-align: center;
         margin: 16px 0 20px 0;
     }

     .image-wrapper img {
         max-width: 100%;
         max-height: 280px;
         border-radius: 6px;
     }

     .content {
         font-size: 11pt;
         line-height: 1.7;
         color: #343a40;
         text-align: justify;
     }

     .footer {
         margin-top: 28px;
         padding-top: 10px;
         border-top: 1px solid #dee2e6;
         font-size: 8.5pt;
         color: #6c757d;
     }
     </style>
 </head>

 <body>
     <div class="header">
         <div class="brand">PWEB UKRIM — Portal Berita</div>
         <div class="badge"><?= htmlspecialchars($newsItem['category_name']) ?></div>
         <h1><?= htmlspecialchars($newsItem['title']) ?></h1>
         <div class="meta">
             Ditulis oleh <strong><?= htmlspecialchars($newsItem['user_name'] ?? 'Admin') ?></strong>
             •
             <?= htmlspecialchars($tanggalTampil) ?>
         </div>
     </div>

     <?php if ($imageDataUri !== null): ?>
     <div class="image-wrapper">
         <img src="<?= $imageDataUri ?>" alt="<?= htmlspecialchars($newsItem['title']) ?>">
     </div>
     <?php endif; ?>

     <div class="content">
         <?= nl2br(htmlspecialchars($newsItem['content'])) ?>
     </div>

     <div class="footer">
         Diunduh dari PWEB UKRIM pada <?= date('d F Y, H:i') ?> WIB
     </div>
 </body>

 </html>