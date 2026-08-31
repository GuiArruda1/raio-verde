document.addEventListener('DOMContentLoaded', () => {
    const header = document.getElementById('masthead');
    const hero = document.querySelector('.hero-section');
    
    // Cache layout threshold outside of scroll listener to prevent layout thrashing (Synchronous Reflow)
    let threshold = hero ? hero.offsetHeight - header.offsetHeight : 100;
    
    window.addEventListener('resize', () => {
        threshold = hero ? hero.offsetHeight - header.offsetHeight : 100;
    });
    
    // Use passive event listener to decouple scroll performance from JavaScript thread
    window.addEventListener('scroll', () => {
        if (window.scrollY > threshold) {
            header.classList.add('is-scrolled');
        } else {
            header.classList.remove('is-scrolled');
        }
    }, { passive: true });

    // Mobile Menu Toggle
    const menuToggle = document.querySelector('.menu-toggle');
    const mainNavigation = document.querySelector('.main-navigation');

    if (menuToggle && mainNavigation) {
        const toggleMenu = () => {
            menuToggle.classList.toggle('is-open');
            mainNavigation.classList.toggle('is-open');
            document.body.classList.toggle('menu-is-open');
            
            // Toggle aria-expanded
            const isExpanded = menuToggle.getAttribute('aria-expanded') === 'true';
            menuToggle.setAttribute('aria-expanded', !isExpanded);
        };

        menuToggle.addEventListener('click', toggleMenu);

        // Close menu overlay when clicking navigation links (especially anchor links on same page)
        const menuLinks = document.querySelectorAll('.main-navigation a, .desktop-side-menu a');
        menuLinks.forEach(link => {
            link.addEventListener('click', () => {
                if (menuToggle.classList.contains('is-open')) {
                    toggleMenu();
                }
            });
        });
    }

    // Portfolio Archive Client-Side Filtering
    const filterLinks = document.querySelectorAll('.portfolio-filter .filter-link');

    if (filterLinks.length > 0) {
        filterLinks.forEach(link => {
            link.addEventListener('click', (e) => {
                e.preventDefault();

                // Update active class on filter menu
                filterLinks.forEach(l => l.classList.remove('active'));
                link.classList.add('active');

                const filterValue = link.getAttribute('data-filter');
                const gallery = document.querySelector('.portfolio-archive-gallery');
                const portfolioItems = document.querySelectorAll('.portfolio-archive-gallery .portfolio-item');



                if (gallery && portfolioItems.length > 0) {
                    // Step 1: Snappy fade out
                    gallery.classList.add('is-filtering');

                    setTimeout(() => {
                        // Reset scroll position of the carousel to the left
                        gallery.scrollLeft = 0;

                        // Step 2: Update layout (hide/show items)
                        portfolioItems.forEach(item => {
                            if (filterValue === 'all') {
                                item.classList.remove('hidden');
                            } else {
                                const categories = item.getAttribute('data-categories') || '';
                                const categoriesArray = categories.split(' ');
                                if (categoriesArray.includes(filterValue)) {
                                    item.classList.remove('hidden');
                                } else {
                                    item.classList.add('hidden');
                                }
                            }
                        });

                        // Step 3: Snappy fade in
                        gallery.classList.remove('is-filtering');
                        
                    }, 350); // Duration matches CSS transition speed
                }
            });
        });


    }

    // Home Portfolio Mobile Load More (CSS reveal)
    const homeLoadMoreBtn = document.getElementById('home-mobile-load-more');
    const homeGallery = document.querySelector('.portfolio-gallery');

    if (homeLoadMoreBtn && homeGallery) {
        let isHomeFetching = false;
        
        const homeObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting && !isHomeFetching) {
                    isHomeFetching = true;
                    
                    // Show loading state
                    homeLoadMoreBtn.classList.add('is-loading');
                    const textWrapper = homeLoadMoreBtn.querySelector('.text-wrapper');
                    const textOriginal = homeLoadMoreBtn.querySelector('.text-original');
                    
                    if(textWrapper && textOriginal) {
                        textWrapper.setAttribute('data-text', 'loading...');
                        textOriginal.innerText = 'loading...';
                    }

                    // Simulate network loading time (e.g., 800ms) before revealing
                    setTimeout(() => {
                        homeGallery.classList.add('is-expanded');
                        homeLoadMoreBtn.parentElement.style.display = 'none'; // Hide the load more container
                        homeObserver.disconnect();
                    }, 800);
                }
            });
        }, {
            rootMargin: '0px 0px 200px 0px', // Trigger 200px before it fully comes into view
            threshold: 0
        });

        homeObserver.observe(homeLoadMoreBtn.parentElement);
    }

    // Portfolio Archive Mobile Load More (Ajax Pagination)
    const gallery = document.querySelector('.portfolio-archive-gallery');
    const loadMoreBtn = document.getElementById('mobile-load-more-btn');
    const paginationContainer = document.querySelector('.portfolio-pagination');

    if (gallery && loadMoreBtn && paginationContainer) {
        let isFetching = false;

        loadMoreBtn.addEventListener('click', (e) => {
            e.preventDefault();
            if (isFetching) return;

            const nextLink = paginationContainer.querySelector('a');
            if (!nextLink) {
                loadMoreBtn.style.display = 'none';
                return;
            }

            const fetchUrl = nextLink.href;
            isFetching = true;
            loadMoreBtn.classList.add('is-loading');

            fetch(fetchUrl)
                .then(response => {
                    if (!response.ok) throw new Error('HTTP error ' + response.status);
                    return response.text();
                })
                .then(htmlString => {
                    const parser = new DOMParser();
                    const doc = parser.parseFromString(htmlString, 'text/html');

                    // Extract new items
                    const newItems = doc.querySelectorAll('.portfolio-archive-gallery .portfolio-item');
                    const newItemsArray = Array.from(newItems);
                    
                    if (newItemsArray.length > 0) {
                        const activeFilter = document.querySelector('.portfolio-filter .filter-link.active');
                        const activeFilterValue = activeFilter ? activeFilter.getAttribute('data-filter') : 'all';

                        newItemsArray.forEach((item, index) => {
                            // Apply active filter state to new items
                            if (activeFilterValue !== 'all') {
                                const categories = item.getAttribute('data-categories') || '';
                                const categoriesArray = categories.split(' ');
                                if (!categoriesArray.includes(activeFilterValue)) {
                                    item.classList.add('hidden');
                                }
                            }
                            
                            // Premium staggered slide-up animation
                            item.style.animationDelay = `${index * 0.06}s`;
                            item.classList.add('lazy-loaded');
                            gallery.appendChild(item);
                        });
                    }

                    // Extract new pagination link
                    const newPagination = doc.querySelector('.portfolio-pagination');
                    if (newPagination && newPagination.querySelector('a')) {
                        paginationContainer.innerHTML = newPagination.innerHTML;
                    } else {
                        paginationContainer.innerHTML = '';
                        loadMoreBtn.style.display = 'none';
                    }

                    isFetching = false;
                    loadMoreBtn.classList.remove('is-loading');
                })
                .catch(err => {
                    console.error('Error loading more portfolios:', err);
                    isFetching = false;
                    loadMoreBtn.classList.remove('is-loading');
                });
        });
    }

    // Cookie Banner Logic
    const cookieBanner = document.getElementById('rv-cookie-banner');
    if (cookieBanner) {
        const consent = localStorage.getItem('rv_cookie_consent');
        if (!consent) {
            cookieBanner.style.display = 'flex';
            // Slight delay to allow CSS transition
            setTimeout(() => {
                cookieBanner.classList.add('is-visible');
            }, 100);
        }

        const handleConsent = (value) => {
            localStorage.setItem('rv_cookie_consent', value);
            cookieBanner.classList.remove('is-visible');
            setTimeout(() => {
                cookieBanner.style.display = 'none';
            }, 800); // Matches CSS transition duration
        };

        document.getElementById('cookie-accept')?.addEventListener('click', () => handleConsent('accepted'));
        document.getElementById('cookie-reject')?.addEventListener('click', () => handleConsent('rejected'));
    }

    // Video Modal Logic for Single Portfolio
    const videoModal = document.getElementById('video-modal');
    const videoContainer = document.getElementById('video-container');
    const openVideoBtns = document.querySelectorAll('.js-open-video-modal');
    const closeVideoBtns = document.querySelectorAll('.js-close-video-modal');

    if (videoModal && videoContainer) {
        // Function to extract video ID and create embed URL
        const getEmbedUrl = (url) => {
            let embedUrl = url;
            // Handle YouTube
            if (url.includes('youtube.com') || url.includes('youtu.be')) {
                let videoId = '';
                if (url.includes('youtu.be/')) {
                    videoId = url.split('youtu.be/')[1].split('?')[0];
                } else if (url.includes('watch?v=')) {
                    videoId = url.split('watch?v=')[1].split('&')[0];
                }
                if (videoId) {
                    embedUrl = `https://www.youtube.com/embed/${videoId}?autoplay=1&rel=0`;
                }
            }
            // Handle Vimeo
            else if (url.includes('vimeo.com')) {
                const videoId = url.split('vimeo.com/')[1].split('?')[0];
                if (videoId) {
                    embedUrl = `https://player.vimeo.com/video/${videoId}?autoplay=1&title=0&byline=0&portrait=0`;
                }
            }
            return embedUrl;
        };

        openVideoBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                const url = btn.getAttribute('data-video-url');
                if (url) {
                    const embedUrl = getEmbedUrl(url);
                    // Create iframe
                    videoContainer.innerHTML = `<iframe src="${embedUrl}" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen></iframe>`;
                    // Show modal
                    videoModal.setAttribute('aria-hidden', 'false');
                    document.body.style.overflow = 'hidden'; // prevent scroll
                }
            });
        });

        const closeModal = () => {
            videoModal.setAttribute('aria-hidden', 'true');
            videoContainer.innerHTML = ''; // clear iframe to stop playing
            document.body.style.overflow = ''; // restore scroll
        };

        closeVideoBtns.forEach(btn => {
            btn.addEventListener('click', closeModal);
        });

        // Close on Escape key
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && videoModal.getAttribute('aria-hidden') === 'false') {
                closeModal();
            }
        });
    }

});
