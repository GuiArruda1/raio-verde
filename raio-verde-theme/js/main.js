document.addEventListener('DOMContentLoaded', () => {
    const header = document.getElementById('masthead');
    const hero = document.querySelector('.hero-section');
    
    // Cache layout threshold outside of scroll listener to prevent layout thrashing (Synchronous Reflow)
    // Math.max ensures threshold is never 0 or negative (e.g. when hero has no ACF content set)
    const getThreshold = () => hero ? Math.max(hero.offsetHeight - header.offsetHeight, 80) : 80;
    let threshold = getThreshold();
    
    window.addEventListener('resize', () => {
        threshold = getThreshold();
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

    // Portfolio Archive Client-Side Filtering (Top Menu = Parents, In-Page = Children)
    const childFilterLinks = document.querySelectorAll('.portfolio-filter-children .filter-link');
    const gallery = document.querySelector('.portfolio-archive-gallery');
    const portfolioItems = document.querySelectorAll('.portfolio-archive-gallery .portfolio-item');
    const topNavLinks = document.querySelectorAll('.main-navigation a, .desktop-side-menu a');

    if (gallery && portfolioItems.length > 0) {
        let currentParentFilter = 'all';

        const applyFilter = (filterValue) => {
            // Step 1: Snappy fade out
            gallery.classList.add('is-filtering');

            setTimeout(() => {
                // Reset scroll position
                gallery.scrollLeft = 0;

                // Step 2: Update layout (hide/show items dynamically)
                const currentItems = gallery.querySelectorAll('.portfolio-item');
                currentItems.forEach(item => {
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

                if (typeof window.rvUpdateBatchVisibility === 'function') {
                    window.rvUpdateBatchVisibility();
                }

                // Step 3: Snappy fade in
                gallery.classList.remove('is-filtering');
            }, 350);
        };

        // Filter child category links in the in-page bar based on selected parent
        const filterChildrenByParent = (parentSlug) => {
            currentParentFilter = parentSlug;
            childFilterLinks.forEach(link => {
                const childParentSlug = link.getAttribute('data-parent-slug');
                const isAllButton = link.getAttribute('data-filter') === 'all';
                const parentLi = link.closest('li');

                if (isAllButton) {
                    link.classList.add('active');
                    if (parentLi) parentLi.style.display = '';
                } else if (parentSlug === 'all' || childParentSlug === parentSlug) {
                    link.classList.remove('active');
                    if (parentLi) parentLi.style.display = '';
                } else {
                    link.classList.remove('active');
                    if (parentLi) parentLi.style.display = 'none';
                }
            });
        };

        const updateURLParam = (paramValue) => {
            if (window.history && window.history.pushState) {
                let newUrl = '/portfolio/';
                if (paramValue && paramValue !== 'all') {
                    newUrl = '/portfolio_category/' + encodeURIComponent(paramValue) + '/';
                }
                window.history.pushState({ category: paramValue }, '', newUrl);
            }
        };

        // Top Header Navigation: Parent Categories Click Handler
        topNavLinks.forEach(link => {
            link.addEventListener('click', (e) => {
                const href = link.getAttribute('href') || '';
                const linkText = link.textContent.trim().toLowerCase();
                const cleanText = linkText.replace(/[\s&]+/g, '-').replace(/[^a-z0-9-]/g, '');

                // Find matching parent slug from child metadata (strict exact match)
                const matchedChild = Array.from(childFilterLinks).find(c => {
                    const pSlug = c.getAttribute('data-parent-slug');
                    if (!pSlug) return false;
                    const cleanParentSlug = pSlug.replace(/[\s&]+/g, '-').replace(/[^a-z0-9-]/g, '');
                    return (
                        href.includes('/portfolio_category/' + pSlug) ||
                        href.includes('category=' + pSlug) ||
                        cleanText === cleanParentSlug ||
                        linkText === pSlug.replace(/-/g, ' ')
                    );
                });

                if (matchedChild) {
                    const parentSlug = matchedChild.getAttribute('data-parent-slug');

                    // Detect if we are currently on a specific taxonomy archive page (/portfolio_category/slug/)
                    const currentTaxMatch = window.location.pathname.match(/\/portfolio_category\/([^\/]+)/);
                    const currentTaxSlug = currentTaxMatch ? currentTaxMatch[1] : null;

                    // If currently on a taxonomy archive page and clicking a DIFFERENT parent category,
                    // navigate to the target category page so WordPress loads its posts
                    if (currentTaxSlug && currentTaxSlug !== parentSlug) {
                        if (href && href !== '#' && !href.startsWith('javascript:')) {
                            window.location.href = href;
                        } else {
                            window.location.href = '/portfolio_category/' + encodeURIComponent(parentSlug) + '/';
                        }
                        return;
                    }

                    e.preventDefault();
                    const isAlreadyActive = link.closest('li')?.classList.contains('current-menu-item');

                    if (isAlreadyActive) {
                        // Deselect parent and restore all
                        topNavLinks.forEach(l => l.closest('li')?.classList.remove('current-menu-item', 'active'));
                        filterChildrenByParent('all');
                        applyFilter('all');
                        updateURLParam('all');
                    } else {
                        // Activate this parent in top header nav
                        topNavLinks.forEach(l => l.closest('li')?.classList.remove('current-menu-item', 'active'));
                        link.closest('li')?.classList.add('current-menu-item', 'active');

                        // Filter child buttons to only show children of this parent
                        filterChildrenByParent(parentSlug);

                        // Apply filter to portfolio items
                        applyFilter(parentSlug);
                        updateURLParam(parentSlug);
                    }
                }
            });
        });

        // In-Page Child Filter Click Handler
        childFilterLinks.forEach(link => {
            link.addEventListener('click', (e) => {
                e.preventDefault();
                const filterValue = link.getAttribute('data-filter');

                if (filterValue === 'all') {
                    // Complete reset: clear top menu selection, reveal all child options, show all posts
                    currentParentFilter = 'all';
                    topNavLinks.forEach(l => l.closest('li')?.classList.remove('current-menu-item', 'active'));
                    filterChildrenByParent('all');
                    applyFilter('all');
                    updateURLParam('all');
                } else {
                    childFilterLinks.forEach(l => l.classList.remove('active'));
                    link.classList.add('active');
                    applyFilter(filterValue);
                    updateURLParam(filterValue);
                }
            });
        });

        // Check initial category from URL query, data attribute, or URL pathname (e.g. /portfolio_category/products-industry/)
        const filterContainer = document.querySelector('.portfolio-filter-container');
        const urlParams = new URLSearchParams(window.location.search);
        let initialCategory = urlParams.get('category') || (filterContainer ? filterContainer.getAttribute('data-initial-term') : '');

        if (!initialCategory) {
            const pathMatch = window.location.pathname.match(/\/portfolio_category\/([^\/]+)/);
            if (pathMatch && pathMatch[1]) {
                initialCategory = pathMatch[1];
            }
        }

        if (initialCategory) {
            const cleanInitCat = initialCategory.replace(/[\s&]+/g, '-').replace(/[^a-z0-9-]/g, '');

            // Check if initialCategory is a parent
            const matchedParentLink = Array.from(topNavLinks).find(link => {
                const href = link.getAttribute('href') || '';
                const linkText = link.textContent.trim().toLowerCase();
                const cleanText = linkText.replace(/[\s&]+/g, '-').replace(/[^a-z0-9-]/g, '');
                return href.includes('/portfolio_category/' + initialCategory) || href.includes('category=' + initialCategory) || cleanText === cleanInitCat;
            });

            if (matchedParentLink) {
                matchedParentLink.closest('li')?.classList.add('current-menu-item', 'active');
                filterChildrenByParent(initialCategory);
                applyFilter(initialCategory);
            } else {
                // Check if initialCategory is a child
                const matchedChildLink = Array.from(childFilterLinks).find(c => c.getAttribute('data-filter') === initialCategory);
                if (matchedChildLink) {
                    const pSlug = matchedChildLink.getAttribute('data-parent-slug');
                    if (pSlug) {
                        filterChildrenByParent(pSlug);
                        const cleanPSlug = pSlug.replace(/[\s&]+/g, '-').replace(/[^a-z0-9-]/g, '');
                        const pLink = Array.from(topNavLinks).find(l => {
                            const href = l.getAttribute('href') || '';
                            const linkText = l.textContent.trim().toLowerCase();
                            const cleanText = linkText.replace(/[\s&]+/g, '-').replace(/[^a-z0-9-]/g, '');
                            return href.includes('/portfolio_category/' + pSlug) || href.includes('category=' + pSlug) || cleanText === cleanPSlug;
                        });
                        pLink?.closest('li')?.classList.add('current-menu-item', 'active');
                    }
                    childFilterLinks.forEach(l => l.classList.remove('active'));
                    matchedChildLink.classList.add('active');
                    applyFilter(initialCategory);
                }
            }
        }
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

    // Portfolio Archive Infinite Scroll (IntersectionObserver)
    const archiveGallery = document.querySelector('.portfolio-archive-gallery');
    const sentinel = document.getElementById('portfolio-infinite-sentinel');
    const paginationContainer = document.querySelector('.portfolio-pagination');

    if (archiveGallery && sentinel) {
        let isFetching = false;
        let visibleCount = 9; // Display 9 items initially (3 full rows of 3)

        const updateBatchVisibility = () => {
            const allItems = Array.from(archiveGallery.querySelectorAll('.portfolio-item'));
            const matchingItems = allItems.filter(item => !item.classList.contains('hidden'));

            matchingItems.forEach((item, index) => {
                if (index < visibleCount) {
                    if (item.classList.contains('is-batch-hidden')) {
                        item.classList.remove('is-batch-hidden');
                        item.classList.add('is-revealing');
                    }
                } else {
                    item.classList.add('is-batch-hidden');
                    item.classList.remove('is-revealing');
                }
            });

            const hasMoreDOMItems = matchingItems.length > visibleCount;
            const hasMorePages = paginationContainer && paginationContainer.querySelector('a');

            if (!hasMoreDOMItems && !hasMorePages) {
                sentinel.classList.add('is-hidden');
            } else {
                sentinel.classList.remove('is-hidden');
            }
        };

        window.rvUpdateBatchVisibility = () => {
            visibleCount = 9;
            updateBatchVisibility();
        };

        // Initial batch setup
        updateBatchVisibility();

        const infiniteObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (!entry.isIntersecting) return;

                const allItems = Array.from(archiveGallery.querySelectorAll('.portfolio-item'));
                const matchingItems = allItems.filter(item => !item.classList.contains('hidden'));
                const hasMoreDOMItems = matchingItems.length > visibleCount;

                if (hasMoreDOMItems) {
                    visibleCount += 9;
                    updateBatchVisibility();
                } else if (paginationContainer && !isFetching) {
                    const nextLink = paginationContainer.querySelector('a');
                    if (!nextLink) {
                        sentinel.classList.add('is-hidden');
                        return;
                    }

                    isFetching = true;
                    sentinel.classList.remove('is-hidden');

                    fetch(nextLink.href)
                        .then(response => {
                            if (!response.ok) throw new Error('HTTP error ' + response.status);
                            return response.text();
                        })
                        .then(htmlString => {
                            const parser = new DOMParser();
                            const doc = parser.parseFromString(htmlString, 'text/html');

                            const newItems = doc.querySelectorAll('.portfolio-archive-gallery .portfolio-item');
                            const newItemsArray = Array.from(newItems);

                            if (newItemsArray.length > 0) {
                                const activeFilter = document.querySelector('.portfolio-filter-children .filter-link.active');
                                const activeFilterValue = activeFilter ? activeFilter.getAttribute('data-filter') : 'all';

                                newItemsArray.forEach(item => {
                                    item.classList.add('is-batch-hidden');
                                    if (activeFilterValue !== 'all') {
                                        const categories = item.getAttribute('data-categories') || '';
                                        const categoriesArray = categories.split(' ');
                                        if (!categoriesArray.includes(activeFilterValue)) {
                                            item.classList.add('hidden');
                                        }
                                    }
                                    archiveGallery.appendChild(item);
                                });

                                const newPagination = doc.querySelector('.portfolio-pagination');
                                if (newPagination) {
                                    paginationContainer.innerHTML = newPagination.innerHTML;
                                } else {
                                    paginationContainer.innerHTML = '';
                                }

                                visibleCount += 9;
                                updateBatchVisibility();
                            } else {
                                sentinel.classList.add('is-hidden');
                            }
                            isFetching = false;
                        })
                        .catch(err => {
                            console.error('Infinite scroll fetch error:', err);
                            sentinel.classList.add('is-hidden');
                            isFetching = false;
                        });
                }
            });
        }, {
            rootMargin: '0px 0px 300px 0px', // Trigger 300px before scroll hits the sentinel
            threshold: 0.1
        });

        infiniteObserver.observe(sentinel);
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
