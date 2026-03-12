<style>
    :root {
        --primary-color: #6366f1;
        --secondary-color: #8b5cf6;
        --text-dark: #1f2937;
        --text-light: #6b7280;
        --bg-light: #f9fafb;
        --border-color: #e5e7eb;
    }
    body {
        font-family: 'Inter', sans-serif;
        line-height: 1.7;
        color: var(--text-dark);
    }
    .navbar {
        background: rgba(255,255,255,0.95);
        backdrop-filter: blur(20px);
        box-shadow: 0 2px 20px rgba(0,0,0,0.08);
    }
    .hero-img {
        height: 60vh;
        object-fit: cover;
        border-radius: 20px 20px 0 0;
    }
    .blog-meta {
        color: var(--text-light);
        font-size: 0.9rem;
    }
    .blog-meta i {
        color: var(--primary-color);
        margin-right: 0.5rem;
    }
    .article-content {
        font-size: 1.1rem;
        line-height: 1.8;
    }
    .article-content h2, .article-content h3 {
        color: var(--text-dark);
        font-weight: 700;
        margin-top: 2.5rem;
        margin-bottom: 1rem;
    }
    .article-content h4 {
        color: var(--primary-color);
        font-weight: 600;
        margin-top: 2rem;
        margin-bottom: 1rem;
    }
    .social-share {
        border-top: 1px solid var(--border-color);
        padding-top: 2rem;
        margin-top: 3rem;
    }
    .related-post {
        border: none;
        border-radius: 15px;
        overflow: hidden;
        transition: all 0.3s ease;
        height: 100%;
    }
    .related-post:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 40px rgba(99,102,241,0.15);
    }
    .author-card {
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        border-radius: 20px;
        color: white;
    }
    .footer {
        background: var(--text-dark);
        color: white;
    }
    .btn-primary-custom {
        background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
        border: none;
        border-radius: 50px;
        padding: 10px 25px;
        font-weight: 500;
        transition: all 0.3s;
    }
    .btn-primary-custom:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(99,102,241,0.4);
    }
    .content-divider {
        height: 1px;
        background: linear-gradient(90deg, transparent, var(--border-color), transparent);
        margin: 4rem 0;
    }
</style>