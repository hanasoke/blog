@extends('layouts.user.template')

@section('content')
<!-- Blog Content -->
<section class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-xl-8">
                <!-- Blog Header -->
                <div class="mb-4">
                    <div class="blog-meta d-flex align-items-center mb-2">
                        <i class="bi bi-calendar3"></i> &nbsp; 
                        <span>{{ $blog->created_at ? $blog->created_at->format('F d, Y') : 'Date not set' }}</span>
                        <span class="mx-3">•</span>
                        <i class="bi bi-clock"></i> &nbsp;
                        <span>{{ $blog->reading_time ?? '5' }} min read</span>
                        <span class="mx-3">•</span>
                        <i class="bi bi-eye"></i> &nbsp;
                        <span>{{ $blog->views ?? '0' }} views</span>
                    </div>
                    <h1 class="display-4 fw-bold mb-4">{{ $blog->title }}</h1>
                    <div class="d-flex align-items-center flex-wrap gap-3">
                        <!-- Author Avatar -->
                        
                        <img src="{{ asset('img_detail_blogs/profile/miku_4.jpg') }}" class="rounded-circle" width="50" height="50" alt="Author">
                        <div>
                            <h6 class="fw-bold mb-0">Sarah Johnson</h6>
                            <small class="text-muted">Senior Brand Strategist</small>
                        </div>
                        <div class="ms-auto">
                            <a href="#" class="btn btn-outline-primary btn-sm me-2">
                                <i class="bi bi-share"></i> Share
                            </a>
                            <button class="btn btn-outline-secondary btn-sm">
                                <i class="bi bi-bookmark"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Article Content -->
                <div class="article-content">
                    <p>Branding is your identity that you use to differentiate yourself from other businesses. Your brand is what your customers say about you when you're not in the room.</p>

                    <h2>Why Branding Matters to Your Business</h2>
                    <p>Branding helps build trust, communicates your values, and creates emotional connections with your audience. It's the foundation of your business identity.</p>

                    <div class="row g-4 mb-5">
                        <div class="col-md-4">
                            <div class="text-center p-4 border rounded-3">
                                <i class="bi bi-shield-check display-4 text-primary mb-3"></i>
                                <h5>Brand Identity</h5>
                                <p>Visual elements that represent your business</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="text-center p-4 border rounded-3">
                                <i class="bi bi-chat-text display-4 text-primary mb-3"></i>
                                <h5>Communication</h5>
                                <p>Your brand voice and messaging</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="text-center p-4 border rounded-3">
                                <i class="bi bi-star display-4 text-primary mb-3"></i>
                                <h5>Experience</h5>
                                <p>Customer interactions and feelings</p>
                            </div>
                        </div>
                    </div>

                    <h2>Rule 1: Be Authentic</h2>
                    <p>Authenticity builds trust. Your brand should genuinely reflect your values, mission, and culture. Customers can spot inauthenticity from a mile away.</p>

                    <h3>Rule 2: Stay Consistent</h3>
                    <p>Consistency across all touchpoints creates recognition. From your logo to your social media posts, maintain visual and tonal consistency.</p>

                    <h4>Visual Consistency Checklist:</h4>
                    <ul class="list-group list-group-flush mb-4">
                        <li class="list-group-item border-0 px-0 py-2">Logo usage guidelines</li>
                        <li class="list-group-item border-0 px-0 py-2">Color palette (primary, secondary, accent)</li>
                        <li class="list-group-item border-0 px-0 py-2">Typography standards</li>
                        <li class="list-group-item border-0 px-0 py-2">Imagery style guide</li>
                    </ul>

                    <blockquote class="blockquote border-start border-4 border-primary ps-4 py-4 bg-light rounded-end">
                        <p class="mb-0 fs-5">"Your brand is a living entity. It evolves, but it must remain true to its core values."</p>
                        <footer class="blockquote-footer mt-3">Simon Sinek, Author</footer>
                    </blockquote>

                    <h2>Rule 3: Know Your Audience</h2>
                    <p>Deeply understand your target customers. Create buyer personas and tailor your messaging to their needs, pain points, and aspirations.</p>

                    <div class="content-divider"></div>

                    <h2>Complete Branding Framework</h2>
                    <p>Effective branding combines strategy, creativity, and consistency. Here's our proven 7-step framework:</p>
                    
                    <div class="row g-3 mb-5">
                        <div class="col-md-6 col-lg-4">
                            <div class="d-flex align-items-center p-3 border rounded-3">
                                <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                                    1
                                </div>
                                <div>
                                    <h6 class="fw-bold mb-0">Discovery</h6>
                                    <small>Research & Analysis</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <div class="d-flex align-items-center p-3 border rounded-3">
                                <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                                    2
                                </div>
                                <div>
                                    <h6 class="fw-bold mb-0">Strategy</h6>
                                    <small>Positioning & Messaging</small>
                                </div>
                            </div>
                        </div>
                        <!-- Continue pattern for 7 steps -->
                    </div>

                    <h2>Conclusion: Branding is Your Competitive Advantage</h2>
                    <p>Investing in strategic branding creates lasting value. It's not just about looking good—it's about building trust, recognition, and loyalty that translates to business growth.</p>

                    <div class="alert alert-primary">
                        <strong>Ready to elevate your brand?</strong> 
                        <a href="#" class="alert-link fw-bold">Contact us today</a> for a free brand audit.
                    </div>
                </div>

                <!-- Social Share & Tags -->
                <div class="social-share">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <h6 class="fw-bold mb-2">Share this article:</h6>
                            <div class="d-flex gap-2">
                                <a href="#" class="btn btn-outline-primary btn-sm px-3 py-2">
                                    <i class="bi bi-facebook me-1"></i>Facebook
                                </a>
                                <a href="#" class="btn btn-outline-primary btn-sm px-3 py-2">
                                    <i class="bi bi-twitter me-1"></i>Twitter
                                </a>
                                <a href="#" class="btn btn-outline-primary btn-sm px-3 py-2">
                                    <i class="bi bi-linkedin me-1"></i>LinkedIn
                                </a>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h6 class="fw-bold mb-2">Tags:</h6>
                            <a href="#" class="badge bg-light text-dark me-2 mb-1">#Branding</a>
                            <a href="#" class="badge bg-light text-dark me-2 mb-1">#Design</a>
                            <a href="#" class="badge bg-light text-dark me-2 mb-1">#Strategy</a>
                            <a href="#" class="badge bg-light text-dark">#Marketing</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Author Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-3 text-center text-md-start mb-4 mb-md-0">
                <img src="{{ asset('img_detail_blogs/profile/miku_4.jpg') }}" class="rounded-circle shadow-lg" width="120" height="120" alt="Sarah Johnson">
            </div>
            <div class="col-md-9">
                <h4 class="fw-bold mb-2">Sarah Johnson</h4>
                <p class="text-muted mb-2">Senior Brand Strategist at Foundry</p>
                <p>With 10+ years in branding, Sarah helps businesses create identities that resonate and convert.</p>
                <a href="#" class="btn btn-primary-custom">View all posts</a>
            </div>
        </div>
    </div>
</section>

<!-- Related Posts -->
<section class="py-5">
    <div class="container">
        <h2 class="fw-bold mb-5 text-center">Related Posts</h2>
        <div class="row g-4">
            <div class="col-md-6 col-lg-4">
                <article class="related-post h-100 shadow-lg">
                    <img src="{{ asset('img_detail_blogs/gallery/raja_ampat.jpg') }}" class="w-100" style="height: 200px; object-fit: cover;" alt="Post">
                    <div class="p-4">
                        <div class="blog-meta mb-2">
                            <i class="bi bi-calendar3"></i> Jan 10, 2024
                        </div>
                        <h5 class="fw-bold mb-3">The Psychology of Color in Branding</h5>
                        <p class="text-muted mb-3">Discover how colors influence customer perception...</p>
                        <a href="#" class="text-decoration-none">Read more <i class="bi bi-arrow-right ms-1"></i></a>
                    </div>
                </article>
            </div>
            <div class="col-md-6 col-lg-4">
                <article class="related-post h-100 shadow-lg">
                    <img src="{{ asset('img_detail_blogs/gallery/nusa_peninda.jpg') }}" class="w-100" style="height: 200px; object-fit: cover;" alt="Post">
                    <div class="p-4">
                        <div class="blog-meta mb-2">
                            <i class="bi bi-calendar3"></i> Dec 28, 2023
                        </div>
                        <h5 class="fw-bold mb-3">Logo Design Trends for 2024</h5>
                        <p class="text-muted mb-3">Minimalism, gradients, and experimental typography...</p>
                        <a href="#" class="text-decoration-none">Read more <i class="bi bi-arrow-right ms-1"></i></a>
                    </div>
                </article>
            </div>
            <div class="col-md-6 col-lg-4">
                <article class="related-post h-100 shadow-lg">
                    <img src="{{ asset('img_detail_blogs/gallery/toba_lake.jpg') }}" class="w-100" style="height: 200px; object-fit: cover;" alt="Post">
                    <div class="p-4">
                        <div class="blog-meta mb-2">
                            <i class="bi bi-calendar3"></i> Feb 5, 2024
                        </div>
                        <h5 class="fw-bold mb-3">Building Brand Loyalty</h5>
                        <p class="text-muted mb-3">Strategies for creating lifelong customers...</p>
                        <a href="#" class="text-decoration-none">Read more <i class="bi bi-arrow-right ms-1"></i></a>
                    </div>
                </article>
            </div>
        </div>
    </div>
</section>

@endsection 