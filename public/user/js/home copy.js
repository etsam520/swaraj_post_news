'use strict';
const hostname = document.querySelector("meta[name='hostname']").getAttribute("content");
const PUBLIC_PATH = document.querySelector("meta[name='public_path']").getAttribute("content");
const STORAGE_PATH = PUBLIC_PATH + "storage/";
// const STORAGE_PATH = "/storage/app/public/uploads/";public_path

/*=========// get cities //==============*/

const cityContainer = document.getElementById("cities");
const getCity =  ()=> {
    if (hostname != null) {
        const url = hostname + "/cities";
        fetch(url).then(response => response.json())
        .then(data => {
            const citiesData = data;
            citiesData.forEach(city => {
                // Default to English locale
                const cityName = city.translations.find(translation => translation.locale === "en")?.city_name || city.city_name;

                // Create an <li> element
                const li = document.createElement("li");

                // Create an <a> element
                const a = document.createElement("a");
                a.href = "javascript:void(0)";
                a.textContent = cityName;

                // Append the <a> to <li>
                li.appendChild(a);

                // Append the <li> to the <ul>
                cityContainer.appendChild(li);
            });
        }).catch(error => {
            console.error(error);
        })
    }
};
getCity();

/*=========// get categories //==============*/
const categoryContainer = document.getElementById("categories");
const getCategory =  ()=> {
    if (hostname != null) {
        const url = hostname + "/categories";
        fetch(url).then(response => response.json())
        .then(data => {
            const categoriesData = data;
            categoriesData.forEach(category => {
                // Get the English name by default
                const categoryName = category.translations.find(translation => translation.locale === "en")?.category_name || category.category_name;

                // Create <li> element
                const li = document.createElement("li");

                // Create <a> element
                const a = document.createElement("a");
                a.href = `#${category.category_slug}`;
                a.className = "text-white";
                a.textContent = categoryName;

                // Append <a> to <li>
                li.appendChild(a);

                // Append <li> to the <ul>
                categoryContainer.appendChild(li);
            });
        }).catch(error => {
            console.error(error);
        })
    }
};
getCategory();

/*=========// get news //==============*/
const getTopNews = () => {
    if (hostname != null) {
        const url = hostname + "/news";
        fetch(url)
            .then(response => response.json())
            .then(data => {
                const topNews = data;
                const topNewsWrapper = document.querySelector("#top-news-wrapper");

                // Clear existing slides if needed
                topNewsWrapper.innerHTML = "";

                topNews.forEach(newsItem => {
                    // Determine locale (default to English)
                    const translation = newsItem.translations.find(t => t.locale === "en") || newsItem.translations[0];

                    // Create Swiper slide
                    const swiperSlide = document.createElement("div");
                    swiperSlide.className = "swiper-slide";

                    // Create article content
                    // src="${PUBLIC_PATH +"storage/"+ newsItem.thumbnail || 'assets/images/common/img-fallback.png'}"
                    swiperSlide.innerHTML =`
                        <div>
                            <article class="post type-post panel uc-transition-toggle gap-2">
                                <div class="row child-cols g-2" data-uc-grid>
                                    <div class="col-auto">
                                        <div class="post-media panel overflow-hidden max-w-64px min-w-64px">
                                            <div class="featured-image bg-gray-25 dark:bg-gray-800 ratio ratio-1x1">
                                                <img class="media-cover image uc-transition-scale-up uc-transition-opaque"
                                                    src="${STORAGE_PATH + newsItem.thumbnail || 'assets/images/common/img-fallback.png'}"
                                                    alt="${translation.headline || 'No headline available'}"
                                                    loading="lazy">
                                            </div>
                                            <a href="news-details.html?slug=${translation.slug}" class="position-cover"></a>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="post-header panel vstack justify-between gap-1">
                                            <h3 class="post-title h6 m-0 text-truncate-1">
                                                <a class="text-none hover:text-primary duration-150"
                                                    href="news-details.html?slug=${translation.slug}">
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
                    topNewsWrapper.appendChild(swiperSlide);
                });
            })
            .catch(error => {
                console.error("Error fetching news:", error);
            });
    }
};

getTopNews();

/*=========// get political news  //==============*/
const insertPoliticalNews = (newsData) => {
    const container = document.getElementById("political-container");
    container.innerHTML = '';

    newsData.forEach(news => {
        // Create a new div for each news article
        const articleDiv = document.createElement("div");
        articleDiv.innerHTML = `
            <article class="post type-post panel uc-transition-toggle">
                <div class="row child-cols g-2 lg:g-3" data-uc-grid>
                    <div>
                        <div class="post-header panel vstack justify-between gap-1">
                            <h3 class="post-title h6 m-0 text-truncate-2">
                                <a class="text-none hover:text-primary duration-150" href="/news/${news.slug}">
                                    ${news.headline}
                                </a>
                            </h3>
                            <div class="post-date hstack gap-narrow fs-7 text-gray-900 dark:text-white text-opacity-60 d-none md:d-flex">
                                <span>${new Date(news.created_at).toLocaleDateString()}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-auto">
                        <div class="post-media panel overflow-hidden max-w-72px min-w-72px">
                            <div class="featured-image bg-gray-25 dark:bg-gray-800 ratio ratio-1x1">
                                <img class="media-cover image uc-transition-scale-up uc-transition-opaque"
                                     src="assets/images/common/img-fallback.png"
                                     data-src="${ news.thumbnail ? STORAGE_PATH +news.thumbnail : 'assets/images/common/img-fallback.png'}"
                                     alt="${news.headline}"
                                     data-uc-img="loading: lazy">
                            </div>
                            <a href="/news/${news.slug}" class="position-cover"></a>
                        </div>
                    </div>
                </div>
            </article>
        `;
        // Append the article div to the container
        container.appendChild(articleDiv);
    });
};

// Fetch political news and insert them into the container
const getPoliticalNews = () => {
    if (hostname != null) {
        const url = hostname + "/political-news";
        fetch(url)
            .then(response => response.json())
            .then(data => {
                insertPoliticalNews(data); // Call the insert function with the fetched data
            })
            .catch(error => console.error("Error fetching political news:", error));
    }
};

// Call the function to fetch and display news
getPoliticalNews();


/*=========// get top News Slider  //==============*/
const getTopNewsSlider = () => {
    if (hostname != null) {
        const url = hostname + "/top-news-slider";
        fetch(url)
            .then(response => response.json())
            .then(data => {
                // console.log(data);
                insertTopNewsSlider(data)
                // insertPoliticalNews(data); // Call the insert function with the fetched data
            })
            .catch(error => console.error("Error fetching political news:", error));
    }
};
const insertTopNewsSlider = (newsData) => { //
    const topNewsSlider = document.querySelector("#top-news-slider .swiper-wrapper");
    topNewsSlider.innerHTML = "";


    newsData.forEach(newsItem => {
        const slide = document.createElement("div");
        slide.className = "swiper-slide";

        // Determine locale (default to English)
        const translation = newsItem.translations.find(t => t.locale === "en") || newsItem.translations[0];

        const news = {
            image: STORAGE_PATH + newsItem.image,
            headline: translation.headline,
            author: newsItem.creator.name,
            authorImage: newsItem.creator.profile_photo,
            comments: Math.floor(Math.random() * 51),
            link: "blog-details.html",
            date: timeAgo(newsItem.created_at)
        }

        slide.innerHTML = `
            <article class="post type-post panel uc-transition-toggle vstack gap-2 lg:gap-3 h-100 overflow-hidden uc-dark">
                <div class="post-media panel overflow-hidden h-100">
                    <div class="featured-image bg-gray-25 dark:bg-gray-800 h-100 d-none md:d-block">
                        <canvas class="h-100 w-100"></canvas>
                        <img class="media-cover image uc-transition-scale-up uc-transition-opaque"
                             src="assets/images/common/img-fallback.png"
                             data-src="${news.image}"
                             alt="${news.headline}"
                             data-uc-img="loading: lazy">
                    </div>
                    <div class="featured-image bg-gray-25 dark:bg-gray-800 ratio ratio-16x9 d-block md:d-none">
                        <img class="media-cover image uc-transition-scale-up uc-transition-opaque"
                             src="assets/images/common/img-fallback.png"
                             data-src="${news.image}"
                             alt="${news.headline}"
                             data-uc-img="loading: lazy">
                    </div>
                </div>
                <div class="position-cover bg-gradient-to-t from-black to-transparent opacity-90"></div>
                <div class="post-header panel vstack justify-end items-start gap-1 p-2 sm:p-4 position-cover text-white" data-swiper-parallax-y="-24">
                    <div class="post-date hstack gap-narrow fs-7 text-gray-900 dark:text-white text-opacity-60 d-none md:d-flex">
                        <span>${news.date}</span>
                    </div>
                    <h3 class="post-title h5 lg:h4 xl:h3 m-0 max-w-600px text-white text-truncate-2">
                        <a class="text-none text-white" href="${news.link}">${news.headline}</a>
                    </h3>
                    <div>
                        <div class="post-meta panel hstack justify-between fs-7 text-white text-opacity-60 mt-1">
                            <div class="meta">
                                <div class="hstack gap-2">
                                    <div>
                                        <div class="post-author hstack gap-1">
                                            <a href="page-author.html" data-uc-tooltip="${news.author}">
                                                <img src="${news.authorImage}" alt="${news.author}" class="w-24px h-24px rounded-circle">
                                            </a>
                                            <a href="page-author.html" class="text-black dark:text-white text-none fw-bold">${news.author}</a>
                                        </div>
                                    </div>
                                    <div>
                                        <a href="#post_comment" class="post-comments text-none hstack gap-narrow">
                                            <i class="icon-narrow unicon-chat"></i>
                                            <span>${news.comments}</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="actions">
                                <div class="hstack gap-1"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </article>
        `;

        topNewsSlider.appendChild(slide);
    });
};
getTopNewsSlider();

// Call the function to populate the slider

/*=========// get Catogorised News  //==============*/
const getCategorisedNews = () => {
    if (hostname != null) {
        const url = hostname + "/categorised-news";
        fetch(url)
            .then(response => response.json())
            .then(data => {
                const category = [];

                const categorisedNewsArray = Object.values(data); // Assuming `data` is an object containing categories and news.
                console.log(categorisedNewsArray);

                for (const categorizedNews of categorisedNewsArray) {
                    const tags = [];
                    const taggedNews = [];
                    const assignedNews = new Set(); // Track assigned news to prevent duplicates.

                    // Collect unique tags
                    for (const news of categorizedNews.news) {
                        news.tags.forEach(tag => {
                            if (!tags.includes(tag)) {
                                tags.push(tag);
                            }
                        });
                    }

                    // Organize news by tags
                    tags.forEach(tag => {
                        const newsArray = [];
                        categorizedNews.news.forEach(news => {
                            if (news.tags.includes(tag) && !assignedNews.has(news)) {
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

                    console.log(categorizedNews);
                }

                console.log(category);
                displayCategorizedNews(category); // Assuming `displayCategorizedNews` is defined elsewhere.
            }).catch(error => console.error("Error fetching political news:", error));
    }
};

getCategorisedNews();
function displayCategorizedNews(categories) {
    const container = document.querySelector("#view-categorised-news");

    container.innerHTML = ""; // Clear any existing content

    categories.forEach(categoryItem => {
        // Create the category header

        if(categoryItem.news.length === 0) return;

        const categoryHeader =
            `
                <div class="block-header panel pb-2 mb-2 border-bottom">
                    <h2 class="h6 ft-tertiary fw-bold ls-0 text-uppercase m-0 text-black dark:text-white">
                        <a class="hstack d-inline-flex gap-0 text-none hover:text-primary duration-150"
                            href="blog-category.html">
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
                                                href="blog-details.html">${newsItem.headline}</a>
                                        </h3>
                                        <div class="post-date hstack gap-narrow fs-7 text-gray-900 dark:text-white text-opacity-60 d-none md:d-flex">
                                            <span>${newsItem.publish_at !=null ? timeAgo(newsItem.publish_at) : ''}</span>
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
                                        <a href="blog-details.html" class="position-cover"></a>
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
function timeAgo(inputTime) {
    const now = new Date();
    const past = new Date(inputTime);
    const diffInSeconds = Math.floor((now - past) / 1000);

    if (diffInSeconds < 60) {
        return diffInSeconds === 1 ? "a second ago" : `${diffInSeconds} seconds ago`;
    }

    const diffInMinutes = Math.floor(diffInSeconds / 60);
    if (diffInMinutes < 60) {
        return diffInMinutes === 1 ? "a minute ago" : `${diffInMinutes} minutes ago`;
    }

    const diffInHours = Math.floor(diffInMinutes / 60);
    if (diffInHours < 24) {
        return diffInHours === 1 ? "an hour ago" : `${diffInHours} hours ago`;
    }

    const diffInDays = Math.floor(diffInHours / 24);
    return diffInDays === 1 ? "a day ago" : `${diffInDays} days ago`;
}





