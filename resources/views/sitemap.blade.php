<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    
    <!-- Pages statiques -->
    <url>
        <loc>{{ url('/') }}</loc>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
    </url>
    <url>
        <loc>{{ url('/search') }}</loc>
        <changefreq>weekly</changefreq>
        <priority>0.5</priority>
    </url>
    <url>
        <loc>{{ url('/cart') }}</loc>
        <changefreq>weekly</changefreq>
        <priority>0.3</priority>
    </url>
    
    <!-- Catégories -->
    @foreach($categories as $category)
    <url>
        <loc>{{ route('category.show', $category->id) }}</loc>
        <lastmod>{{ $category->updated_at->format('Y-m-d') }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
    </url>
    @endforeach
    
    <!-- Produits -->
    @foreach($products as $product)
    <url>
        <loc>{{ route('product.show', $product->id) }}</loc>
        <lastmod>{{ $product->updated_at->format('Y-m-d') }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.6</priority>
    </url>
    @endforeach
    
</urlset>