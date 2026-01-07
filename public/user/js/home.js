'use strict';

document.addEventListener("DOMContentLoaded", function () {
    display_top_news();
    insertPoliticalNews();// Call the function to fetch and display news
    featuredNews(); // Call the function to fetch and display top news slider
    process_categoryData(); // Call the function to fetch and display categorised news
    // insertLiveNews(); // Call the function to fetch and display live video news
    renderVisualStories(); // Call the function to fetch and display visual stories
});
/*=========// get news //==============*/
async function display_top_news() {
    const topNews = await GlobalData.getTopNewsSlider() || []; // Use GlobalData to get top news if available
    const topNewsWrapper = document.querySelector("#top-news-wrapper");

    // Clear existing slides if needed
    topNewsWrapper.innerHTML = `
        <div class="container-fluid">
            <div class="swiper news-swiper">
                <div class="swiper-wrapper">
                ${
                    topNews.map((newsItem, index) => {
                        return `
                            <div class="swiper-slide">
                                <a href="${NEWS_PATH + newsItem.slug}">
                                    <div class="news-card">
                                        <img src="${S3_Path + newsItem.thumbnail || 'assets/images/common/img-fallback.png'}" alt="news" height="500px">
                                        <div class="text">
                                            <div class="title">${newsItem?.headline || 'No title available'}</div>
                                            <div class="desc">${newsItem?.quote || 'No description available'}</div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        `;
                    }).join('')
                }   
                </div>
              
            </div>
        </div>
    `;
    new Swiper(".news-swiper", {
        slidesPerView: 1,
        spaceBetween: 12,
        navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
        },
        breakpoints: {
        1200: { slidesPerView: 4 },
        992: { slidesPerView: 2 },
        600: { slidesPerView: 1 },
        },
    });


    /*
    topNews.forEach(newsItem => {
        // Determine locale (default to English)
        const translation = newsItem.translations.find(t => t.locale === getLocale()) || newsItem.translations[0];

        // Create Swiper slide
        const swiperSlide = document.createElement("div");
        swiperSlide.className = "swiper-slide";

        // Create article content
        // src="${PUBLIC_PATH +"storage/"+ newsItem.thumbnail || 'assets/images/common/img-fallback.png'}"
        swiperSlide.innerHTML = `
                <div>
                    <article class="post type-post panel uc-transition-toggle gap-2">
                        <div class="row child-cols g-2" data-uc-grid>
                            <div class="col-auto">
                                <div class="post-media panel overflow-hidden max-w-64px min-w-64px">
                                    <div class="featured-image bg-gray-25 dark:bg-gray-800 ratio ratio-1x1">
                                        <img class="media-cover image uc-transition-scale-up uc-transition-opaque"
                                            src="${S3_Path + newsItem.thumbnail || 'assets/images/common/img-fallback.png'}"
                                            alt="${translation.headline || 'No headline available'}"
                                            loading="lazy">
                                    </div>
                                    <a href="${NEWS_PATH + translation.slug}" class="position-cover"></a>
                                </div>
                            </div>
                            <div>
                                <div class="post-header panel vstack justify-between gap-1">
                                    <h3 class="post-title h6 m-0 text-truncate-1">
                                        <a class="text-none hover:text-primary duration-150"
                                            href="${NEWS_PATH + translation.slug}">
                                            ${translation.headline || 'No headline available'}
                                        </a>
                                    </h3>
                                    <p class="text-gray-500 small text-truncate-2">
                                        ${translation.quote || ''}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </article>
                </div>`;

        // Append slide to swiper wrapper
        topNewsWrapper.querySelectorAll("article").forEach(wrapper => {
            wrapper.addEventListener("click", function () {
                location.href = NEWS_PATH + translation.slug;
            });
        });
        topNewsWrapper.appendChild(swiperSlide);
    });
    */
}

/*=========// get political news  //==============*/
const insertPoliticalNews = async () => {
    const newsData = await GlobalData.getPoliticalNews(); // Use GlobalData to get political news if available
    const container = document.getElementById("political-container");
    container.innerHTML = '';
    container.innerHTML=`
        <div class="featured-news-sidebar">
            <div class="featured-news-sidebar-title">
                Politics <i class="fas fa-chevron-right sidebar-chevron"></i>
            </div>
            <hr class="featured-news-sidebar-hr">
            ${newsData.map((newsItem, index) => {
                if(index > 5) return null;
                const translation = newsItem.translations.find(t => t.locale === getLocale()) || newsItem.translations[0];
                const _single_news = {
                    image: S3_Path + newsItem.image,
                    thumbnail: S3_Path + newsItem.thumbnail,
                    headline: translation.headline,
                    author: newsItem?.creator?.name || 'Swarajya Post',
                    // authorImage: newsItem.creator.profile_photo,
                    authorImage: PUBLIC_PATH + "/assets/images/brand/swaraj-post-logo.png",
                    comments: Math.floor(Math.random() * 51),
                    link: NEWS_PATH + translation.slug,
                    date: timeAgo(newsItem.created_at)
                }
                return `
                <div class="featured-news-sidebar-item" type="button" onclick="location.href='${_single_news.link}'">
                    <img src="${_single_news.image || _single_news.thumbnail}" alt="news" class="featured-news-sidebar-img">
                    <div>
                        <div class="featured-news-sidebar-item-title">${_single_news.headline}</div>
                        <div class="featured-news-sidebar-item-time">${_single_news.date}</div>
                    </div>
                </div>
                `
            }).join('')}
        </div>
    `;



    
    // document.getElementById('political-tab').href = GlobalData.hostname + "/category-news/" + `${getLocale() === 'en' ? 'politics' : 'rajanata'}`;
};

/*=========// get top News Slider  //==============*/
const featuredNews = async (newsData = []) => { //
    newsData = await GlobalData.getTopNewsSlider() || newsData; // Use GlobalData to get top news slider if available
    const featuredNewsContainer = document.getElementById("featured-news-container");
    featuredNewsContainer.innerHTML = "";
    featuredNewsContainer.innerHTML = `
        <div class="swiper featured-news-swiper rounded-2 overflow-hidden">
            <div class="swiper-wrapper">
            ${
                newsData.map(newsItem => {
                    const translation = newsItem.translations.find(t => t.locale === getLocale()) || newsItem.translations[0];
                    const _single_news = {
                        image: S3_Path + newsItem.image,
                        thumbnail: S3_Path + newsItem.thumbnail,
                        headline: translation.headline,
                        author: newsItem.creator.name || 'Swarajya Post',
                        // authorImage: newsItem.creator.profile_photo,
                        authorImage: PUBLIC_PATH + "/assets/images/brand/swaraj-post-logo.png",
                        comments: Math.floor(Math.random() * 51),
                        link: NEWS_PATH + translation.slug,
                        date: timeAgo(newsItem.created_at)
                    }

                    return `
                        <div class="swiper-slide">
                            <div class="featured-news-card position-relative">
                                <img src="${_single_news.thumbnail ? S3_Path + _single_news.thumbnail : 'assets/images/common/img-fallback.png'}" style="width:100%; min-height:600px;
                                    alt="featured news" class="featured-news-img">
                                <div class="featured-news-overlay">
                                    <div class="featured-news-time">${_single_news.date}</div>
                                    <div class="featured-news-title">${_single_news.headline}</div>
                                    <div class="featured-news-meta">
                                        <span class="fw-semibold">${_single_news.author }</span>
                                        <span><i class="far fa-comment-alt"></i> ${_single_news.comments ||getSingleRandomNumber() }</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;
                }).join('')
            }
            </div>
            <div class="swiper-button-next featured-swiper-btn"></div>
            <div class="swiper-button-prev featured-swiper-btn"></div>
        </div>
    `;

    new Swiper(".featured-news-swiper", {
        slidesPerView: 1,
        navigation: {
        nextEl: ".featured-news-swiper .swiper-button-next",
        prevEl: ".featured-news-swiper .swiper-button-prev",
        },
        loop: true,
    });

};

/*=========// get Catogorised News  //==============*/
async function process_categoryData() {
    const data = await GlobalData.getCategorizedNews() || []; // Use GlobalData to get categorised news if available
    const category = [];

    const categorisedNewsArray = Object.values(data); // Assuming `data` is an object containing categories and news.


    for (const categorizedNews of categorisedNewsArray) {
        const tags = [];
        const taggedNews = [];
        const assignedNews = new Set(); // Track assigned news to prevent duplicates.

        // Collect unique tags
        for (const news of categorizedNews.news) {

            if (!news.tags || news.tags.length === 0) continue; // Skip news without tags
            news.tags?.forEach(tag => {
                if (!tags.includes(tag)) {
                    tags.push(tag);
                }
            });
        }

        // Organize news by tags
        tags.forEach(tag => {
            const newsArray = [];
            categorizedNews.news.forEach(news => {

                if ((news.tags || news.tags?.length == 0) && news.tags.includes(tag) && !assignedNews.has(news)) {
                    newsArray.push(news);
                    assignedNews.add(news); // Mark news as assigned to prevent duplication.
                }
            });
            if (newsArray.length > 0) {
                taggedNews.push({ tag, news: newsArray });
            }
        });

        // Push category data
        category.push({
            category: categorizedNews.category_name,
            tags,
            news: taggedNews
        });

        // console.log(categorizedNews);
    }
    displayCategorizedNews(categorisedNewsArray);
}

function displayCategorizedNews(categorisedNewsArray) {
    // console.log(categorisedNewsArray);
    // return;
    const container = document.querySelector("#category-section-news");

    container.innerHTML = ""; // Clear any existing content
    // container.innerHTML = 

    categorisedNewsArray.forEach(categoryItem => {
        // Create the category header

        if (categoryItem.news.length === 0) return;

    

        // console.log(categoryItem.news);
        const newsArray = categoryItem.news;
        const numSections = 2;
        const newsPerSection = Math.ceil(newsArray.length / numSections);

        const dividedArrays = [];
        for (let i = 0; i < numSections; i++) {
            const start = i * newsPerSection;
            const end = Math.min((i + 1) * newsPerSection, newsArray.length);
            dividedArrays.push(newsArray.slice(start, end));
        }

        // Iterate through tags and their news
        const newsListcontent = dividedArrays
            .map(newsList => {
                // console.log(tagItem)
                // return tagItem.news;

                const newsItems = newsList
                    .map(
                        (newsItem, index) => {
                            return `

                                <div style="display:flex; align-items:center; gap:10px; margin-bottom:18px;">
                                    <img src="${S3_Path + newsItem.thumbnail}" alt="side"
                                        style="width:70px; height:50px; object-fit:cover; border-radius:6px;">
                                    <a href="${NEWS_PATH + newsItem.slug}" style="font-size:1rem; color:#222; font-weight:600;">
                                        ${newsItem.headline}
                                    </a>
                                </div>
                                ${index < newsList.length - 1 ? `<hr style="margin:0 0 18px 0; border-top:1px solid #eee;">` : ''}
                            `;

                        }).join("");

                return `
                        <div class="col-lg-4 col-md-5">
                            <div>
                                ${newsItems}
                            </div>
                        </div>
                    `;
            })
            .join("");

        const categoryContent = `
            <div class="container-fluid">
                <div style="font-size:1.4rem; font-weight:700; color:#222; display:flex; align-items:center; gap:8px;">
                    <span style="color:#e74c3c; font-size:1.3rem;">&#9679;</span>
                    <span>${categoryItem.category_name}</span>
                    <a href=""${hostname + "/category-news/" + categoryItem?.category_slug}""
                        style="margin-left:auto; color:#e74c3c; font-weight:700; font-size:1rem; text-decoration:none;">और
                        भी <span style="font-size:1.1rem;">&#8250;</span>
                    </a>
                </div>
                <div class="row" style="margin-top:16px;">
                    <div class="col-lg-4 col-md-7 mb-3">
                        <div style="background:#fff; border-radius:8px; overflow:hidden;">
                            <img src="${S3_Path + newsArray[0].image || "assets/images/common/img-fallback.png"}" alt="main"
                                style="width:100%; height:260px; object-fit:cover;">
                            <a href="${NEWS_PATH + newsArray[0].slug}" style="padding:16px 12px; font-size:1.25rem; font-weight:700; color:#111;">
                                ${newsArray[0].headline}
                            </a>
                        </div>
                    </div>
                    ${newsListcontent}
                </div>
            </div>
        `;


        console.log(container);

        container.insertAdjacentHTML("beforeend", categoryContent);
    });
}
function ddisplayCategorizedNews(categories) {
    const container = document.querySelector("#view-categorised-news");

    container.innerHTML = ""; // Clear any existing content

    categories.forEach(categoryItem => {
        // Create the category header

        if (categoryItem.news.length === 0) return;

        const categoryHeader =
            `
                <div class="block-header panel pb-2 mb-2 border-bottom">
                    <h2 class="h6 ft-tertiary fw-bold ls-0 text-uppercase m-0 text-black dark:text-white">
                        <a class="hstack d-inline-flex gap-0 text-none hover:text-primary duration-150"
                            href="javascript:void(0)">
                            <h4 class="fw-bolder text-danger mb-0">${categoryItem.category}
                                <i class="icon-1 fw-bold unicon-chevron-right"></i>
                            </h4>
                        </a>
                    </h2>
                </div>
            `;


        // Iterate through tags and their news
        const tagContent = categoryItem.news
            .map(tagItem => {

                const newsItems = tagItem.news
                    .map(
                        newsItem => `
                    <div>
                        <article class="post type-post panel uc-transition-toggle">
                            <div class="row child-cols g-2 lg:g-3" data-uc-grid>
                                <div>
                                    <div class="post-header panel vstack justify-between gap-1">
                                        <h3 class="post-title h6 m-0 text-truncate-2">
                                            <a class="text-none hover:text-primary duration-150"
                                                href="${NEWS_PATH + newsItem.slug}">${newsItem.headline}</a>
                                        </h3>
                                        <div class="post-date hstack gap-narrow fs-7 text-gray-900 dark:text-white text-opacity-60 d-none md:d-flex">
                                            <span>${newsItem.publish_at != null ? timeAgo(newsItem.publish_at) : ''}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <div class="post-media panel overflow-hidden max-w-72px min-w-72px">
                                        <div class="featured-image bg-gray-25 dark:bg-gray-800 ratio ratio-1x1">
                                            <img class="media-cover image uc-transition-scale-up uc-transition-opaque"
                                                src="${newsItem.image || "assets/images/common/img-fallback.png"}"
                                                alt="${newsItem.title}"
                                                data-uc-img="loading: lazy">
                                        </div>
                                        <a href="${NEWS_PATH + newsItem.slug}" class="position-cover"></a>
                                    </div>
                                </div>
                            </div>
                        </article>
                    </div>`
                    )
                    .join("");

                return `
                        <div class="row child-cols-12 lg:child-cols g-4 lg:g-6 col-match" data-uc-grid>
                            <div class="lg:col-4">
                                <div class="block-layout list-layout vstack gap-2 lg:gap-3 panel overflow-hidden">
                                    <div class="block-content">
                                        <div class="row child-cols-12 g-2 lg:g-4 sep-x" data-uc-grid>
                                        ${newsItems}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>`;
            })
            .join("");

        // Wrap the category content
        const categoryContent = `
            <div class="section panel overflow-hidden">
                <div class="section-outer panel py-4 lg:py-6 dark:text-white">
                    <div class="container max-w-xl gap-2 lg:gap-3" >
                    ${categoryHeader}
                    <div class="section-inner">
                        ${tagContent}
                    </div>
                </div>
            </div>`;



        container.insertAdjacentHTML("beforeend", categoryContent);
    });
}

/*=========// get live  News video //==============*/
async function insertLiveNews() {

    const newsData = await GlobalData.getLiveVideoNews() || [];

    if (newsData.length === 0) return;
    console.log(newsData);
    const section = document.getElementById("latest-videos-section");

    section.innerHTML = "";
    section.innerHTML = `
        <div class="container-fluid">
            <div class="row align-items-start">
                <div class="col-lg-4 col-md-5 mb-4">
                    <div
                        style="color:#fff; font-weight:700; font-size:1.2rem; margin-bottom:18px; display:flex; align-items:center; gap:8px;">
                        <span style="color:#e74c3c; font-size:1.5rem;">•</span> LATEST VIDEOS
                    </div>
                    
                    <div class="video-list"
                        style="background:#444; border-radius:12px; padding:16px 0 0 0; margin-bottom:16px;">
                        ${
                            newsData.map(_news => {
                                const translation = _news.translations.find(t => t.locale === "en") || _news.translations[0];

                                const _newsItem = {
                                    thumbnail: STORAGE_PATH + ne_newsws.thumbnail,
                                    headline: translation.headline,
                                    video_url: generateYoutubeEmbedUrl(getYoutubeVideoId(_news.video_link) || ''),
                                    date: timeAgo(_news.created_at),
                                    _thumbnail: S3_Path + new_newss.thumbnail,
                                    headline: translation.headline,
                                };
                                return `
                                <div class="video-list-item"
                                    style="display:flex; align-items:center; gap:14px; padding:10px 18px; border-radius:10px 10px 0 0; background:#333;">
                                    <img src="https://img.youtube.com/vi/${getYoutubeVideoId(_news.video_link)}/mqdefault.jpg" alt="thumb"
                                        style="width:56px; height:56px; border-radius:8px; object-fit:cover;">
                                    <div style="color:#fff; font-size:1rem; font-weight:500; line-height:1.3;">
                                        ${_newsItem.headline}
                                    </div>
                                </div>
                                `;
                            }).join("")
                        }
                        <div class="video-list-item active"
                            style="display:flex; align-items:center; gap:14px; padding:10px 18px; border-radius:10px 10px 0 0; background:#333;">
                            <img src="https://img.youtube.com/vi/VIDEO_ID_1/mqdefault.jpg" alt="thumb"
                                style="width:56px; height:56px; border-radius:8px; object-fit:cover;">
                            <div style="color:#fff; font-size:1rem; font-weight:500; line-height:1.3;">
                                MP Sudhakar Singh made serious allegations against the Rural Works...
                            </div>
                        </div>
                    </div>
                    <div>
                        <button class="video-prev-btn"
                            style="background:#e74c3c; color:#fff; border:none; border-radius:10px; font-weight:700; padding:8px 20px; margin-bottom:6px;">Prev</button>
                        <button class="video-next-btn"
                            style="background:#e74c3c; color:#fff; border:none; border-radius:10px; font-weight:700; padding:8px 20px;">Next</button>
                    </div>
                </div>
                <div class="col-lg-8 col-md-7">
                    <div class="video-player" style="border-radius:16px; overflow:hidden; background:#111;">
                        <iframe id="main-video-iframe" width="100%" height="420"
                            src="https://www.youtube.com/embed/VIDEO_ID_1" frameborder="0" allowfullscreen
                            style="border-radius:16px;"></iframe>
                    </div>
                </div>
            </div>
        </div>

    `;

        /*
    const container = document.getElementById("live_now_video_news");
    const htmlContent = `<div class="section-outer panel py-4 lg:py-6 bg-gray-900 text-white">
            <div class="container max-w-xl">
                <div
                    class="block-layout slider-thumbs-layout slider-thumbs panel vstack gap-2 lg:gap-3 panel overflow-hidden">
                    <div class="block-header panel">
                        <h2
                            class="h6 ft-tertiary fw-bold ls-0 text-uppercase hstack gap-narrow m-0 text-black dark:text-white">
                            <i class="icon-1 fw-bold unicon-dot-mark text-red" data-uc-animate="flash"></i>
                            <span>LATEST VIDEOS</span>
                        </h2>
                    </div>
                    <div class="block-content">
                        <div class="row child-cols-12 g-2" data-uc-grid>
                            <div class="md:col-4 lg:col-4">
                                <div class="panel md:vstack gap-1 h-100">
                                    <div class="swiper swiper-thumbs swiper-thumbs-progress rounded order-2"
                                        data-uc-swiper="items: 2;
                                                        gap: 4;
                                                        disable-class: last-slide;" data-uc-swiper-s="items: auto;
                                                        direction: vertical;
                                                        autoHeight: true;
                                                        mousewheel: true;
                                                        freeMode: false;
                                                        watchSlidesVisibility: true;
                                                        watchSlidesProgress: true;
                                                        watchOverflow: true">
                                        <div class="swiper-wrapper md:flex-1">

                                        ${newsData
            .map(
                (news) => {
                    const translation = news.translations.find(t => t.locale === "en") || news.translations[0];

                    const _newsItem = {
                        thumbnail: STORAGE_PATH + news.thumbnail,
                        headline: translation.headline,
                        video_url: generateYoutubeEmbedUrl(getYoutubeVideoId(news.video_link) || ''),
                        date: timeAgo(news.created_at),
                        _thumbnail: S3_Path + _news.thumbnail,
                        headline: translation.headline,
                    };


                    return `<div class="swiper-slide overflow-hidden rounded min-h-64px lg:min-h-100px">
                                                    <div class="swiper-slide-progress position-cover z-0">
                                                        <span></span>
                                                    </div>
                                                    <article class="post type-post panel uc-transition-toggle p-1 z-1">
                                                        <a href="javascipt:void(0)" style="text-decoration:none;">
                                                            <div class="row gx-1">
                                                                <div class="col-auto post-media-wrap">
                                                                    <div
                                                                        class="post-media panel overflow-hidden w-40px lg:w-64px rounded">
                                                                        <div
                                                                            class="featured-video bg-gray-700 ratio ratio-3x4">
                                                                            ${_newsItem.video_url != null ? `<iframe src="${_newsItem.video_url || ''}" title="" frameborder="0"
                                                                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                                                                referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>`: ''}
                                                                        </div>
                                                                        <div
                                                                            class="has-video-overlay position-absolute top-0 end-0 w-40px h-40px lg:w-64px lg:h-64px bg-gradient-45 from-transparent via-transparent to-black opacity-50">
                                                                        </div>
                                                                        <span
                                                                            class="cstack has-video-icon position-absolute top-50 start-50 translate-middle fs-6 w-40px h-40px text-white">
                                                                            <i
                                                                                class="icon-narrow unicon-play-filled-alt"></i>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <div class="col">
                                                                    <p
                                                                        class="fs-4 m-0 text-truncate-2 text-gray-900 dark:text-white">
                                                                        ${_newsItem.headline}
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </article>
                                                </div>`}).join('')}

                                        </div>
                                    </div>
                                    <div
                                        class="swiper-prev btn btn-2xs lg:btn-xs btn-primary w-100 d-none md:d-flex order-1">
                                        Prev</div>
                                    <div
                                        class="swiper-next btn btn-2xs lg:btn-xs btn-primary w-100 d-none md:d-flex order-3">
                                        Next</div>
                                </div>
                            </div>
                            <div class="md:col-8 lg:col-8">
                                <div class="panel overflow-hidden rounded">
                                    <div class="swiper swiper-main"
                                        data-uc-swiper="connect: .swiper-thumbs; items: 1; gap: 8; autoplay: 7000; parallax: true; fade: true; effect: fade; dots: .swiper-pagination; disable-class: last-slide;">
                                        <div class="swiper-wrapper">
                                         ${newsData
            .map(
                (news) => {
                    const translation = news.translations.find(t => t.locale === "en") || news.translations[0];

                    const _newsItem = {
                        thumbnail: S3_Path + news.thumbnail,
                        headline: translation.headline,
                        video_url: generateYoutubeEmbedUrl(getYoutubeVideoId(news.video_link) || ''),
                        date: timeAgo(news.created_at)
                    };
                    return `
                                                    <div class="swiper-slide">
                                                        <article
                                                            class="post type-post h-250px md:h-350px lg:h-500px bg-black uc-dark">
                                                            <div class="post-media panel overflow-hidden position-cover">
                                                                <div class="featured-video bg-gray-700 ratio ratio-3x2">
                                                                    <iframe src="${_newsItem.video_url || ''}" title="${_newsItem.headline || ''}" frameborder="0"
                                                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                                                        referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                                                                </div>
                                                            </div>

                                                        </article>
                                                    </div>
                                                    `}).join('')}

                                        </div>
                                        <div
                                            class="swiper-pagination top-auto start-auto bottom-0 end-0 m-2 md:m-4 xl:m-6 text-white d-none md:d-inline-flex justify-end w-auto">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    `;
    container.innerHTML = htmlContent;*/
}

/*=========// get news //==============*/
async function renderVisualStories() {
    const visualStories = await GlobalData.getVisualStories() || [];

    const visualStorySection = document.getElementById("visual-stories-section");

    // visualStorySection.innerHTML =  '';
    visualStorySection.innerHTML = `
        <div class="container-fluid">
            <div
                style="font-size:1.5rem; font-weight:700; color:#e74c3c; margin-bottom:8px; display:flex; align-items:center; gap:8px;">
                <span style="color:#e74c3c; font-size:1.5rem;">&#9679;</span>
                <span style="color:#222;">विजुअल स्टोरीज़</span>
            </div>
            <hr style="margin:0 0 24px 0; border-top:1px solid #eee;">
            <div class="swiper visual-stories-swiper">
                <div class="swiper-wrapper">
                    ${
                        visualStories
                        .map(
                            (vsItem) => {
                                const translation = vsItem.translations.find(t => t.locale === "en") || vsItem.translations[0];
                                return `
                                <div class="swiper-slide">
                                    <div
                                        style="background:#fff; border-radius:10px; box-shadow:0 1px 4px rgba(0,0,0,0.06); overflow:hidden; border:1px solid #eee;">
                                        <img src="${vsItem.cover_image}" alt="story"
                                            style="width:100%; height:160px; object-fit:cover;">
                                        <a  href="${hostname + "/visual-story-view/" + vsItem.id}"
                                            style="padding:12px 10px 10px 10px; font-size:1.05rem; font-weight:700; color:#222; min-height:60px;">
                                            ${translation.title}
                                        </div>
                                        <div style="border-top:1px dashed #bbb; margin:0 10px 10px 10px;"></div>
                                    </div>
                                </div>
                                `;
                            }).join('') 
                    }
                </div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
            </div>
        </div>

    `;    // Clear existing slides if needed
   new Swiper(".visual-stories-swiper", {
    slidesPerView: 5,
    spaceBetween: 18,
    navigation: {
      nextEl: ".visual-stories-swiper .swiper-button-next",
      prevEl: ".visual-stories-swiper .swiper-button-prev",
    },
    breakpoints: {
      1200: { slidesPerView: 6 },
      992: { slidesPerView: 4 },
      768: { slidesPerView: 3 },
      480: { slidesPerView: 2 },
      0: { slidesPerView: 2 },
    },
  });
}



























/*=========// Helpers Functions  //==============*/

// function timeAgo(inputTime) {
//     const currentTime = new Date();
//     const pastTime = new Date(inputTime);
//     const diffInSeconds = Math.floor((currentTime - pastTime) / 1000);

//     if (diffInSeconds < 60) {
//         return `${diffInSeconds} seconds ago`;
//     } else if (diffInSeconds < 3600) {
//         const minutes = Math.floor(diffInSeconds / 60);
//         return minutes === 1 ? "1 minute ago" : `${minutes} minutes ago`;
//     } else if (diffInSeconds < 86400) {
//         const hours = Math.floor(diffInSeconds / 3600);
//         return hours === 1 ? "1 hour ago" : `${hours} hours ago`;
//     } else {
//         const days = Math.floor(diffInSeconds / 86400);
//         return days === 1 ? "a day ago" : `${days} days ago`;
//     }
// }





