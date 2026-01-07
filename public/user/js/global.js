'use strict';
const hostname = document.querySelector("meta[name='hostname']").getAttribute("content");
const PUBLIC_PATH = document.querySelector("meta[name='public_path']").getAttribute("content");
const S3_Path = "https://givni.sgp1.digitaloceanspaces.com/";
const STORAGE_PATH = PUBLIC_PATH + "storage/";
const NEWS_PATH = hostname + "/news-details/";
// const STORAGE_PATH = "/storage/app/public/uploads/";
//  http://localhost:8080/swaraj_post_news_live/
const queryString = window.location.search;
const urlParams = new URLSearchParams(queryString);
 
class GlobalDataManager {
    #_stateCity = null; // Private property to store stateCity data
    #_categories = null; // Private property to store categories data
    #_latestNews = null
    #_topBreakingNews = null; // Private property to store top breaking news data
    #_politicalNews = null; // Private property to store political news data
    #_topNewsSlider = null; // Private property to store top news slider data
    #_categorizedNews = null; // Private property to store categorized news data
    #_liveVideoNews = null; // Private property to store live video news data
    #_visualStories = null; // Private property to store visual stories data

    #_newsData = null;
    #_newsDataMeta = {};

    constructor(config) {
        this.hostname = config.hostname;
        this.PUBLIC_PATH = config.PUBLIC_PATH;
        this.S3_Path = config.S3_Path;
        this.STORAGE_PATH = config.STORAGE_PATH;
        this.NEWS_PATH = config.NEWS_PATH;
        this.queryString = config.queryString;
        this.urlParams = config.urlParams;

        // Internal properties to store fetched data
        this._stateCity = null;
        this._categories = null;
        this._latestNews = null; // Initialize latest news data
    }

    // Getter for stateCity, uses caching and fetches if not available
    getStateCity() {
        return this.#fetchStateCity().then(data => {
            this._stateCity = data; // Store fetched data
            return this._stateCity;
        });
    }

    async #fetchStateCity() {
        if (this._stateCity) {
            return this._stateCity; // Already fetched and stored
        }

        const cachedData = getSessionValue('states_cities');
        if (cachedData) {
            this._stateCity = JSON.parse(cachedData);
            return this._stateCity;
        }

        // If not cached, fetch it
        if (this.hostname) {
            const url = this.hostname + "/states_cities";
            try {
                const response = await fetch(url);
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                const data = await response.json();
                setSessionValue('states_cities', JSON.stringify(data), 30 * 60); // 30 minutes
                this._stateCity = data;
                return this._stateCity;
            } catch (error) {
                console.error("Error fetching states and cities:", error);
                this._stateCity = []; // Assign empty array on error for consistency
                return [];
            }
        }
        console.warn("Hostname is not defined, cannot fetch states and cities.");
        this._stateCity = [];
        return [];
    }

    // Getter for categories, uses caching and fetches if not available
    getCategories() {
        return this.#fetchCategories().then(data => {
            this._categories = data; // Store fetched data
            return this._categories;
        });
    }

    async #fetchCategories() {
        if (this._categories) {
            return this._categories; // Already fetched and stored
        }

        const cachedData = getSessionValue('categories');
        if (cachedData) {
            this._categories = JSON.parse(cachedData);
            return this._categories;
        }

        // If not cached, fetch it
        if (this.hostname) {
            const url = this.hostname + "/categories";
            try {
                const response = await fetch(url);
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                const data = await response.json();
                setSessionValue('categories', JSON.stringify(data), 30 * 60); // 30 minutes
                this._categories = data;
                return this._categories;
            } catch (error) {
                console.error("Error fetching categories:", error);
                this._categories = []; // Assign empty array on error
                return [];
            }
        }
        console.warn("Hostname is not defined, cannot fetch categories.");
        this._categories = [];
        return [];
    }

    getLatestNews() {
        return this.#fetchLatestNews().then(data => {
            this._latestNews = data; // Store fetched data
            return this._latestNews;
        });
    }

    async #fetchLatestNews() {
        if (this._latestNews) {
            return this._latestNews; // Already fetched and stored
        }

        if (this.hostname) {
            const params = this.#getQueryPrams({
                state_id: getSessionValue('state_id'),
                city_id: getSessionValue('city_id'),
            });
            const url = this.hostname + "/news" + (params ? '?' + params : ''); // Construct URL with query parameters
            // Append query parameters if available
            try {
                const response = await fetch(url);
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                const data = await response.json();
                this._latestNews = data;
                return this._latestNews;
            } catch (error) {
                console.error("Error fetching latest news:", error);
                this._latestNews = []; // Assign empty array on error
                return [];
            }
        }

        console.warn("Hostname is not defined, cannot fetch latest news.");
        this._latestNews = [];
        return [];
    }

    #getQueryPrams(obj = {}) {
        const params = new URLSearchParams();
        for (const key in obj) {
            if (obj.hasOwnProperty(key) && obj[key] !== undefined && obj[key] !== null) {
                params.append(key, obj[key]);
            }
        }
        return params.toString();
    }

    getTopBreakingNews() {
        return this.#fetchTopBreakingNews().then(data => {
            this._topBreakingNews = data; // Store fetched data
            return this._topBreakingNews;
        });
    }

    async #fetchTopBreakingNews() {
        if (this._topBreakingNews) return this._topBreakingNews; // Already fetched and stored

        if (!this.urlParams.has('q')) return this.getLatestNews();

        if (this.hostname) {
            // Use the hostname and query parameters to construct the URL
            const params = this.#getQueryPrams({
                state_id: getSessionValue('state_id'),
                city_id: getSessionValue('city_id'),
                q: this.urlParams.get('q') // Include the search query if available
            });
            const url = hostname + "/news" + (params ? '?' + params : ''); // Construct URL with query parameters
            try {
                const response = await fetch(url);
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                const data = await response.json();
                this._topBreakingNews = data;
                return this._topBreakingNews;
            } catch (error) {
                console.error("Error fetching top breaking news:", error);
                this._topBreakingNews = []; // Assign empty array on error
                return [];
            }
        }

        console.warn("Hostname is not defined, cannot fetch top breaking news.");
        this._topBreakingNews = [];
        return [];
    }

    getPoliticalNews() {
        return this.#fetchPoliticalNews().then(data => {
            this._politicalNews = data; // Store fetched data
            return this._politicalNews;
        });
    }

    async #fetchPoliticalNews() {
        if (this._politicalNews) return this._politicalNews; // Already fetched and stored

        if (this.hostname) {
            const params = this.#getQueryPrams({
                state_id: getSessionValue('state_id'),
                city_id: getSessionValue('city_id'),
                q: this.urlParams.get('q') // Include the search query if available
            });
            const url = this.hostname + "/political-news" + (params ? '?' + params : ''); // Construct URL with query parameters
            try {
                const response = await fetch(url);
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                const data = await response.json();
                this._politicalNews = data;
                return this._politicalNews;
            } catch (error) {
                console.error("Error fetching political news:", error);
                this._politicalNews = []; // Assign empty array on error
                return [];
            }
        }

        console.warn("Hostname is not defined, cannot fetch political news.");
        this._politicalNews = [];
        return [];
    }

    getTopNewsSlider() {
        return this.#fetchTopNewsSlider().then(data => {
            this._topNewsSlider = data; // Store fetched data
            return this._topNewsSlider;
        });
    }

    async #fetchTopNewsSlider() {
        if (this._topNewsSlider) return this._topNewsSlider; // Already fetched and stored

        if (this.hostname) {
            const params = this.#getQueryPrams({
                state_id: getSessionValue('state_id'),
                city_id: getSessionValue('city_id'),
                q: this.urlParams.get('q') // Include the search query if available
            });
            const url = this.hostname + "/top-news-slider" + (params ? '?' + params : ''); // Construct URL with query parameters
            try {
                const response = await fetch(url);
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                const data = await response.json();
                this._topNewsSlider = data;
                return this._topNewsSlider;
            } catch (error) {
                console.error("Error fetching top news slider:", error);
                this._topNewsSlider = []; // Assign empty array on error
                return [];
            }
        }

        console.warn("Hostname is not defined, cannot fetch top news slider.");
        this._topNewsSlider = [];
        return [];
    }

    getCategorizedNews() {
        return this.#fetchCategorizedNews().then(data => {
            this._categorizedNews = data; // Store fetched data
            return this._categorizedNews;
        });
    }

    async #fetchCategorizedNews() {
        if (this._categorizedNews) return this._categorizedNews; // Already fetched and stored

        if (this.hostname) {
            const params = this.#getQueryPrams({
                state_id: getSessionValue('state_id'),
                city_id: getSessionValue('city_id'),
                q: this.urlParams.get('q') // Include the search query if available
            });
            const url = this.hostname + "/categorised-news" + (params ? '?' + params : ''); // Construct URL with query parameters
            try {
                const response = await fetch(url);
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                const data = await response.json();
                this._categorizedNews = data;
                return this._categorizedNews;
            } catch (error) {
                console.error("Error fetching categorized news:", error);
                this._categorizedNews = []; // Assign empty array on error
                return [];
            }
        }

        console.warn("Hostname is not defined, cannot fetch categorized news.");
        this._categorizedNews = [];
        return [];
    }

    getLiveVideoNews() {
        return this.#fetchLiveVideoNews().then(data => {
            this._liveVideoNews = data; // Store fetched data
            return this._liveVideoNews;
        });
    }

    async #fetchLiveVideoNews() {
        if (this._liveVideoNews) return this._liveVideoNews; // Already fetched and stored

        if (this.hostname) {
            const url = this.hostname + "/live-video-news" + (this.urlParams.has('q') ? '?q=' + this.urlParams.get('q') : '');
            try {
                const response = await fetch(url);
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                const data = await response.json();
                this._liveVideoNews = data;
                return this._liveVideoNews;
            } catch (error) {
                console.error("Error fetching live video news:", error);
                this._liveVideoNews = []; // Assign empty array on error
                return [];
            }
        }

        console.warn("Hostname is not defined, cannot fetch live video news.");
        this._liveVideoNews = [];
        return [];
    }

    getVisualStories() {
        return this.#fetchVisualStories().then(data => {
            this._visualStories = data; // Store fetched data
            return this._visualStories;
        });
    }
    async #fetchVisualStories() {
        if (this._visualStories) return this._visualStories; // Already fetched and stored

        if (this.hostname) {
            const url = this.hostname + "/visual-stories" + (this.urlParams.has('q') ? '?q=' + this.urlParams.get('q') : '');
            try {
                const response = await fetch(url);
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                const data = await response.json();
                this._visualStories = data;
                return this._visualStories;
            } catch (error) {
                console.error("Error fetching visual stories:", error);
                this._visualStories = []; // Assign empty array on error
                return [];
            }
        }

        console.warn("Hostname is not defined, cannot fetch visual stories.");
        this._visualStories = [];
        return [];
    }

    // Reloads the GlobalDataManager instance
    reload() {
        this._stateCity = null; // Reset stateCity data
        this._categories = null; // Reset categories data
        this._latestNews = null; // Reset latest news data
        this._topBreakingNews = null; // Reset top breaking news data
        this._politicalNews = null; // Reset political news data
        this._topNewsSlider = null; // Reset top news slider data
        this._categorizedNews = null; // Reset categorized news data
        // this._liveVideoNews = null; // Reset live video news data
        // this._visualStories = null; // Reset visual stories data
    }
}

class SinglePageNewsManager {
    #_newsData = null; // Private property to store single page news data
    #_slug = null; // Private property to store single page news metadata
    constructor(slug) {
        this._newsData = null; // Initialize news data
        this.#_slug = slug; // Set the slug for fetching news data
    }

    getNewsData() {
        return this.#fetchNewsData().then(data => {
            this._newsData = data; // Store fetched news data
            return this._newsData;
        });
    }

    async #fetchNewsData() {
        if (this._newsData) return this._newsData; // Already fetched and stored

        const slug = this.#_slug || window.location.pathname.split('/').pop(); // Get slug from URL if not set
        if (!slug) {
            console.warn("No slug provided, cannot fetch news data.");
            return null;
        }

        const url = hostname + "/news-data/" + slug;
        try {
            const response = await fetch(url);
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            const data = await response.json();
            this._newsData = data;
            return this._newsData;
        } catch (error) {
            console.error("Error fetching single page news data:", error);
            this._newsData = null; // Assign null on error
            return null;
        }
    }

    setSlug(slug) {
        this.#_slug = slug; // Set the slug for fetching news data
    }
    getSlug() {
        return this.#_slug; // Get the current slug
    }
    clearNewsData() {
        this._newsData = null; // Clear the news data
    }
    clearSlug() {
        this.#_slug = null; // Clear the slug
    }
}

// Initialize the global data manager
const GlobalData = new GlobalDataManager({
    hostname: hostname, // Make sure these are defined in your scope
    PUBLIC_PATH: PUBLIC_PATH,
    S3_Path: S3_Path,
    STORAGE_PATH: STORAGE_PATH,
    NEWS_PATH: NEWS_PATH,
    queryString: queryString,
    urlParams: urlParams,
});



document.addEventListener("DOMContentLoaded", function () {
    displaystatecity(); // get states and cities
    show_category(); // get categories
    displayTopBreakingNews(); // get top breaking news

});

/*=========// get states //==============*/

const displaystatecity = async () => {
    const stateDropdownMenu = document.getElementById("stateDropdownMenu");
    const stateDropdown = document.getElementById("stateDropdown");
    const districtMenu = document.getElementById("districtMenu");

    const statesData = await GlobalData.getStateCity();
    const citiesByState = {};

    stateDropdownMenu.innerHTML = '';

    statesData.forEach(state => {
        const stateName = state.translations.find(translation => translation.locale === "en")?.state_name || state.state_name
        citiesByState[stateName] = state.cities.map(city => {

            return {
                id: city.id,
                name: city.translations.find(translation => translation.locale === getLocale())?.city_name || city.city_name,
                slug: city.translations.find(translation => translation.locale === getLocale())?.city_slug || city.city_slug,
            }
        });

        // Create an <li> element
        const _a = document.createElement("a");
        _a.className = 'dropdown-item d-flex justify-content-between align-items-center';
        _a.href = 'javascript:void(0)'; 
        _a.setAttribute('data-state', stateName);
        _a.setAttribute('data-state-id', state.id);
        _a.textContent = stateName;
        _a.innerHTML += '<i class="fas fa-chevron-right text-muted"></i>';

        _a.onmouseenter = function (e) {
            e.preventDefault();
            
           
            districtMenu.innerHTML = "";
            
            const _a_city = document.createElement("a");
            _a_city.className = 'dropdown-item d-flex justify-content-between align-items-center';
            _a_city.href = 'javascript:void(0)';
            _a_city.textContent = 'Select City';

             _a_city.onclick = function (ev) {
                ev.preventDefault();
                stateDropdown.innerHTML = `<i class="fas fa-map-marker-alt mr-2"></i> ${state} - ${district}`;
                stateDropdownMenu.style.display = "none";
                districtMenu.style.display = "none";
            };
            districtMenu.appendChild(_a_city);

            citiesByState[stateName].forEach((city) => {
                const a = document.createElement("a");
                a.className = "dropdown-item";
                a.href = "#";
                a.textContent = city.name;
                a.setAttribute("data-city", city.name);
                a.setAttribute("data-city-id", city.id);
                a.onclick = function (e) {
                    e.preventDefault();
                    setSessionValue('city_name', city.name, 30 * 60); // Store city name in session for 30 minutes
                    setSessionValue('city_id', city.id, 30 * 60); // Store city ID in session for 30 minutes
                    setSessionValue('state_name', stateName, 30 * 60); // Store state name in session for 30 minutes
                    setSessionValue('state_id', state.id, 30 * 60); // Store state ID in session for 30 minutes
                    stateDropdown.innerHTML = `<i class="fas fa-map-marker-alt mr-2"></i> ${stateName} - ${city.name}`;
                    stateDropdownMenu.style.display = "none";
                    districtMenu.style.display = "none";
                    refreshWeb(); 

                };
                districtMenu.appendChild(a);
            })

            districtMenu.style.display = "block"; // Show district menu
        };

        // Append the <li> to the <ul>
        stateDropdownMenu.appendChild(_a);
    });
    // Hide menus when clicking outside
    document.addEventListener("click", function (e) {
        if (!stateDropdown.parentNode.contains(e.target)) {
        stateDropdownMenu.style.display = "none";
        districtMenu.style.display = "none";
        }
    });

    if (getSessionValue('state_name') && getSessionValue('state_id')) {
        stateDropdown.innerHTML = `<i class="fas fa-map-marker-alt mr-2"></i> ${getSessionValue('state_name')} - ${getSessionValue('city_name')}`;
        stateDropdownMenu.style.display = "none";
        districtMenu.style.display = "none";
    }
}

/*=========// get categories //==============*/
 
async function show_category() {
    const categoriesData = await GlobalData.getCategories();
    displaySidebarCategory(categoriesData);
    displayFooterCategory(categoriesData);

    const categoryNav = document.getElementById("mobile-menu");
    if (!categoryNav) return; 
    // Clear existing categories
    categoryNav.querySelector('ul').innerHTML = `<li><a href="${hostname}">Home</a></li>`; // Clear existing categories
    categoriesData.forEach(category => {

        const categoryName = category.translations.find(translation => translation.locale === getLocale())?.category_name || category.category_name;

        // Create <li> element
        const li = document.createElement("li");

        // Create <a> element
        const a = document.createElement("a");
        a.href = `${hostname + "/category-news/" + category.category_slug}`;
        a.textContent = categoryName;

        // Append <a> to <li>
        li.appendChild(a);

        // Append <li> to the <ul>
        categoryNav.querySelector('ul').appendChild(li);
    });
    const li = document.createElement('li');
    li.innerHTML = `
    <div class="d-block d-lg-none" style="margin:30px 0px;text-align:center;">
        <a href="#"
        style="margin-right:10px; padding: 6px 18px; border-radius: 4px; background: orange; color: #fff; border: none; text-decoration: none;"
        data-toggle="modal" data-target="#loginModal">Sign In</a>
        <a href="#"
        style="padding: 6px 18px; border-radius: 4px; background: #fff; color: #333; border: none; text-decoration: none;"
        data-toggle="modal" data-target="#signupModal" data-dismiss="modal">Sign Up</a>
    </div>
    `;
    categoryNav.querySelector('ul').appendChild(li);
}
function displaySidebarCategory(categoriesData) {

    const sidebarCategoryContainer = document.getElementById('sidebar-category');
    if (!sidebarCategoryContainer) return; // Ensure the container exists
    sidebarCategoryContainer.querySelector('ul').innerHTML = `<li><a href="${hostname}" class="d-block py-2 px-2 text-dark">Home</a></li>`; // Clear existing categories
    categoriesData.forEach(category => {
        // Get the English name by default
        const categoryName = category.translations.find(translation => translation.locale === getLocale())?.category_name || category.category_name;

        // Create <li> element
        const li = document.createElement("li");

        // Create <a> element
        const a = document.createElement("a");
        a.href = `${hostname + "/category-news/" + category.category_slug}`;
        a.className = "d-block py-2 px-2 text-dark";
        // a.className = "text-white";
        a.textContent = categoryName;

        // Append <a> to <li>
        li.appendChild(a);

        // Append <li> to the <ul>
        sidebarCategoryContainer.querySelector('ul').appendChild(li);
    });
}
function displayFooterCategory(categoriesData) {
    const footerCategoryContainer = document.getElementById('footerCategory');
    footerCategoryContainer.querySelector('ul').innerHTML = "";

    categoriesData.forEach(category => {
        const categoryName = category.translations.find(translation => translation.locale === getLocale())?.category_name || category.category_name;
        const li = document.createElement("li");
        const a = document.createElement("a");
        a.href = `${hostname + "/category-news/" + category.category_slug}`;
        a.textContent = categoryName;
        li.appendChild(a);
        footerCategoryContainer.querySelector('ul').appendChild(li);
    });
}

/*=========// Footer Letest Topic //==============*/
const showFooterLetestTopic = (News) => {
    const latestTopicContainer = document.getElementById('footerLatestTopics');
    latestTopicContainer.innerHTML = "";
    const ul = document.createElement("ul");
    
    News.forEach((newsItem, index) => {
        if (index > 4) return; // Limit to 4 items
        const translation = newsItem.translations.find(t => t.locale === getLocale()) || newsItem.translations[0];

        const li = document.createElement("li");
        const a = document.createElement("a");
        a.href = `${NEWS_PATH + translation.slug}`;
        a.textContent = translation.headline || 'No headline available';
        li.appendChild(a);
        ul.appendChild(li);
    });
    latestTopicContainer.appendChild(ul);

}

/*=========// get top breaking news //==============*/
async function displayTopBreakingNews() {
    // const topNews = await GlobalData.getLatestNews();
    const topNews = await GlobalData.getTopNewsSlider();
    
    // const topBreakingNewsContainer = document.getElementById('top-breaking-news');
    const header_sticky = document.getElementById('header-sticky');
    const marquee = header_sticky.querySelector('.marquee');
    // Clear existing slides if needed
    marquee.innerHTML = '';


    topNews.forEach(newsItem => {
        // Determine locale (default to English)
        const translation = newsItem.translations.find(t => t.locale === getLocale()) || newsItem.translations[0];
        const span = document.createElement("span");
        span.innerHTML = `<span>
               <i class="fas fa-square" style="margin-right:8px; font-size: 10px !important;"></i>
             <a href="${NEWS_PATH + translation.slug}" class="text-white">
                ${translation.headline || 'No headline available'}</a>
            </span>`;
        marquee.appendChild(span);
    });

    // display footer latest topics
    showFooterLetestTopic(topNews);
}


//  refresh Data

function refreshWeb() {
    // Refresh the page
    // location.reload();

    // Safely call each function only if it exists
    if (typeof GlobalData?.reload === 'function') GlobalData.reload();
    if (typeof displayTopBreakingNews === 'function') displayTopBreakingNews();
    if (typeof display_top_news === 'function') display_top_news();
    if (typeof insertPoliticalNews === 'function') insertPoliticalNews();
    if (typeof insertTopNewsSlider === 'function') insertTopNewsSlider();
    if (typeof process_categoryData === 'function') process_categoryData();
    if (typeof insertLiveNews === 'function') insertLiveNews();
    if (typeof renderVisualStories === 'function') renderVisualStories();

    console.log("Refreshing the page...");
}


/*=========// user sign up //==============*/
const create_account_form = document.getElementById('create_account_form');
if (create_account_form != null) {
    create_account_form.addEventListener('submit', async function (event) {
        event.preventDefault(); // Prevent default form submission

        // Form Fields
        const form = event.target;
        const userName = form.user_name.value.trim();
        const userEmail = form.user_email.value.trim();
        const userPhone = form.user_phone.value.trim();
        const password = form.password.value;
        const confirmPassword = form.password_confirmation.value;
        const acceptTerms = form.querySelector('#input_checkbox_accept_terms').checked;
        const messageBox = document.getElementById('messageBox');

        // Basic Validation
        if (!userName || !userEmail || !userPhone || !password || !confirmPassword) {
            showMessage("All fields are required!", "danger");
            return;
        }
        if (password.length < 6) {
            showMessage("Password must be at least 6 characters long!", "danger");
            return;
        }
        if (password !== confirmPassword) {
            showMessage("Passwords do not match!", "danger");
            return;
        }
        if (!acceptTerms) {
            showMessage("You must accept the terms and conditions!", "danger");
            return;
        }

        // Prepare Form Data
        const formData = new FormData(form);

        try {
            // Send Form Data using Fetch API
            const url = hostname + "/sign-up-user"

            const response = await fetch(url, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            });

            const result = await response.json(); // Parse JSON response

            if (response.ok) {
                showMessage(result.message || "Account created successfully!", "success");
                form.reset(); // Reset form on success
                set1000(() => {
                    location.reload();
                }, 3000);
            } else {
                showMessage(result.error || "An error occurred. Please try again!", "danger");
            }
        } catch (error) {
            console.error(error);
            showMessage("Server error. Please try again later!", "danger");
        }
    });
}
// Function to Show Messages
function showMessage(message, type) {
    const messageBox = document.getElementById('messageBox');
    messageBox.textContent = message;
    messageBox.className = `alert alert-${type}`;
    messageBox.classList.remove('d-none');

    // Hide message after 3 seconds
    setTimeout(() => messageBox.classList.add('d-none'), 3000);
}
/*=========// user login  //==============*/
const login_form = document.getElementById('login-form');
if (login_form != null) {
    login_form.addEventListener('submit', async function (event) {
        event.preventDefault(); // Prevent default form submission
        // Form Fields
        const form = event.target;
        const userEmail = form.email.value.trim();
        const password = form.password.value;

        // Basic Validation
        if (!userEmail || !password) {
            showLoginMessage("All fields are required!", "danger");
            return;
        }
        if (password.length < 6) {
            showLoginMessage("Password must be at least 6 characters long!", "danger");
            return;
        }

        // Prepare Form Data
        const formData = new FormData(form);

        try {
            // Send Form Data using Fetch API
            const url = hostname + "/login-user"

            const response = await fetch(url, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            });

            const result = await response.json(); // Parse JSON response

            if (response.ok) {
                showLoginMessage(result.message || "Account created successfully!", "success");
                form.reset(); // Reset form on success
                setTimeout(() => {
                    location.reload();
                }, 3000);
            } else {
                showLoginMessage(result.error || "An error occurred. Please try again!", "danger");
            }
        } catch (error) {
            console.error(error);
            showLoginMessage("Server error. Please try again later!", "danger");
        }
    });
}

function showLoginMessage(message, type) {
    const messageBox = document.getElementById('messageBoxLogin');
    messageBox.textContent = message;
    messageBox.className = `alert alert-${type}`;
    messageBox.classList.remove('d-none');

    // Hide message after 3 seconds
    setTimeout(() => messageBox.classList.add('d-none'), 3000);
}


/*=========// Helpers Functions  //==============*/
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
/**
 * Generate a YouTube embed URL from a video ID.
 * @param {string} videoId - The YouTube video ID.
 * @returns {string|null} - The YouTube embed URL or null if invalid.
 */
function generateYoutubeEmbedUrl(videoId) {
    if (!videoId) {
        return null;
    }
    const videoIdPattern = /^[a-zA-Z0-9_-]{11}$/;
    if (videoIdPattern.test(videoId)) {
        return `https://www.youtube.com/embed/${videoId}`;
    }
    return null;
}

/**
 * Extract the YouTube video ID from a URL.
 * @param {string} url - The YouTube video URL.
 * @returns {string|null} - The video ID or null if invalid.
 */
function getYoutubeVideoId(url) {
    if (!url) {
        return null;
    }
    const pattern = /(?:https?:\/\/)?(?:www\.|m\.|music\.)?(?:youtube\.com|youtu\.be)(?:\/embed\/|\/v\/|\/watch\?v=|\/|\?.*?v=)?([a-zA-Z0-9_-]{11})/;
    const match = url.match(pattern);
    return match ? match[1] : null;
}
function getLocale() {
    return document.querySelector("meta[name='locale']").getAttribute("content");
}

function setSessionValue(key, value, minutes = 5) {
    const expiresAt = new Date().getTime() + minutes * 60 * 1000; // current time + 5 mins
    const data = {
        value: value,
        expiresAt: expiresAt
    };
    sessionStorage.setItem(key, JSON.stringify(data));
}
// Get value and check expiration
function getSessionValue(key) {
    const data = sessionStorage.getItem(key);
    if (!data) return null;

    const parsed = JSON.parse(data);
    if (new Date().getTime() > parsed.expiresAt) {
        sessionStorage.removeItem(key); // expired
        return null;
    }
    return parsed.value;
}
function clearSessionValue(key) {
    sessionStorage.removeItem(key);
}
function clearAllSessionValues() {
    sessionStorage.clear();
}
function clearSessionValues(keys = []) {
    keys.forEach(key => sessionStorage.removeItem(key));
}
function convertToDateTimeFormat(input) {
    // Remove "at" and "IST" to avoid parsing issues
    const cleaned = input.replace(" at", "").replace(" IST", "");

    // Parse the cleaned string into a Date object
    const date = new Date(cleaned);

    // Helper function to pad single digits
    const pad = (n) => n < 10 ? '0' + n : n;

    // Format as "YYYY-MM-DD HH:mm:ss"
    return `${date.getFullYear()}-${pad(date.getMonth() + 1)}-${pad(date.getDate())} ` +
        `${pad(date.getHours())}:${pad(date.getMinutes())}:${pad(date.getSeconds())}`;
}

function getSingleRandomNumber() {
  return Math.floor(Math.random() * 80) + 1;
}
