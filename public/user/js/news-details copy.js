
'use strict';

/************************************************************************************\
 *
 *          News Details Page js         News Details Page js       News Details Page js
 *
 ***********************************************************************************/

async function getNewsData(slug) {
    try {

        const news = new SinglePageNewsManager(slug)
        const data = await news.getNewsData();
        renderNewsDetails(data);
        // console.log(data);
        insertNewsDetails(data.news);
        insertCatgorizedNews(data.relatedNews, data.category);
        insertPostNavigation(data.previousNews, data.nextNews);
        insertAuthorDetails(data);
        appendTags(data.tags);
    } catch (error) {
        console.error(error);
    }

}

function insertAuthorDetails(data) {
    const authorArea = document.querySelector('.author-area');
    if (!authorArea) return;
    // console.log(data);
    // return 0 ;
    authorArea.querySelector('img').src = PUBLIC_PATH + "assets/images/brand/swaraj-post-logo.png";
    authorArea.querySelector('.author-name').textContent = data.news?.creator_name || 'Admin';
    authorArea.querySelector('.published-date').textContent = "Published on :" + convertToDateTimeFormat(data.news?.publish_at || data.news?.created_at);
}


function insertNewsDetails(data) {
    const container = document.getElementById('newsDetailsContainer');
    const mainFigure = container.querySelector('.main-figure');
    const mainFigureImage = mainFigure.querySelector('img');
    const headline = container.querySelector('h1.headline');
    const postContent = container.querySelector('.post-content');
    const newsVideoContainer = container.querySelector('#news-video-container');
    const videoIframe = newsVideoContainer.querySelector('iframe');

    const translation = data.translations.find(t => t.locale === getLocale()) || data.translations[0];

    headline.textContent = translation.headline;
    mainFigureImage.src = S3_Path + data.image;
    postContent.innerHTML = translation.details;
    const videoLink = generateYoutubeEmbedUrl(getYoutubeVideoId(data.video_link) || '');
    // dd($tags);


    if (videoLink) {
        videoIframe.src = videoLink;
    } else {
        videoIframe.classList.add('d-none');
    }


}



const renderNewsDetails = (data) => {

    const news = data.news;
    const translation = data.translations.find(t => t.locale === getLocale()) || data.translations[0];

    // console.log(news);
    const mainContainer = document.getElementById('newsDetailsContainer');



    const renderData = `
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-md-10 col-lg-8 px-lg-3 px-0">
                        <div class="news-detail-container">
                            <div class="news-detail-share">
                                <span>Share:</span>
                                <a href="#"><i class="fab fa-facebook-f"></i></a>
                                <a href="#"><i class="fab fa-x-twitter"></i></a>
                                <a href="#"><i class="fab fa-whatsapp"></i></a>
                            </div>
                            <img src="${S3_Path + data.image}" alt="News Image"
                                class="news-detail-image">
                            <div class="news-detail-title" id="news-detail-title">
                               ${translation.headline}                       
                            </div>
                            <div class="news-detail-meta">
                                By <a href="#">John Doe</a>
                                <span>Published :
                                June 01, 2024 at 10:30 AM                                IST</span>
                            </div>
                            <div class="news-detail-content">
                                <p><span class="dropcap">L</span>orem ipsum dolor sit amet, consectetur adipiscing elit. Sed euismod, urna eu tincidunt consectetur, nisi nisl aliquam nunc, eget aliquam massa nisl quis neque. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.</p>
                                <p>Aliquam erat volutpat. Etiam ac mauris lectus. Mauris euismod, sapien nec commodo gravida, enim erat dictum urna, nec dictum velit enim at erat. Suspendisse potenti.</p>
                            </div>
                            <div class="news-detail-nav d-lg-flex justify-content-between mt-4 align-items-center"
                                style="gap: 10px;">
                                <div class="news-prev">
                                    <a href="#"
                                        class="d-flex align-items-center text-decoration-none" style="color:#888;">
                                        <img src="assets/img/news/news-prev.jpg"
                                            alt=""
                                            style="width:48px;height:38px;object-fit:cover;border-radius:6px;box-shadow:0 1px 6px rgba(0,0,0,0.06);margin-right:10px;">
                                        <div>
                                            <div style="font-size:0.9rem;color:#bbb;"><i
                                                class="fa fa-arrow-left mr-2"></i>Prev Article</div>
                                            <div
                                                style="font-weight:600;color:#222;line-height:1.2;font-size:1.05rem;white-space:normal;">
                                                Tech Innovations Reshaping the Retail Landscape: AI Payments                                            
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="news-next">
                                    <a href="#"
                                        class="d-flex align-items-center justify-content-end text-decoration-none"
                                        style="color:#888;">
                                        <div>
                                            <div style="font-size:0.9rem;color:#bbb;text-align:right;">Next Article<i
                                                class="fa fa-arrow-right ml-2"></i></div>
                                            <div
                                                style="font-weight:600;color:#222;line-height:1.2;font-size:1.05rem;white-space:normal;text-align:right;">
                                                The Rise of AI-Powered Personal Assistants: How They Manage
                                            </div>
                                        </div>
                                        <img src="assets/img/news/news-next.jpg"
                                            alt=""
                                            style="width:48px;height:38px;object-fit:cover;border-radius:6px;box-shadow:0 1px 6px rgba(0,0,0,0.06);margin-left:10px;">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 d-none d-lg-block px-lg-3 px-0">
                        <div class="news-list-sidebar"
                            style="background:#fff;border-radius:10px;box-shadow:0 2px 12px rgba(0,0,0,0.04);padding:20px 16px;">
                            <h5 style="font-weight:700;margin-bottom:18px;">Latest News</h5>
                            <ul class="list-unstyled" style="margin:0;padding:0;">
                                <li style="margin-bottom:18px;display:flex;gap:12px;align-items:flex-start;">
                                    <img src="assets/img/news/news1.jpg" alt=""
                                        style="width:56px;height:42px;object-fit:cover;border-radius:6px;box-shadow:0 1px 6px rgba(0,0,0,0.06);flex-shrink:0;">
                                    <div>
                                        <a href="#"
                                            style="font-weight:600;color:#222;text-decoration:none;">
                                        Dummy News Title 1                                        </a>
                                        <div style="font-size:0.95rem;color:#888;">
                                            Jan 01, 2024                                        
                                        </div>
                                    </div>
                                </li>
                                <li style="margin-bottom:18px;display:flex;gap:12px;align-items:flex-start;">
                                    <img src="assets/img/news/news2.jpg" alt=""
                                        style="width:56px;height:42px;object-fit:cover;border-radius:6px;box-shadow:0 1px 6px rgba(0,0,0,0.06);flex-shrink:0;">
                                    <div>
                                        <a href="#"
                                            style="font-weight:600;color:#222;text-decoration:none;">
                                        Dummy News Title 2                                        </a>
                                        <div style="font-size:0.95rem;color:#888;">
                                            Feb 15, 2024                                        
                                        </div>
                                    </div>
                                </li>
                                <li style="margin-bottom:18px;display:flex;gap:12px;align-items:flex-start;">
                                    <img src="assets/img/news/news3.jpg" alt=""
                                        style="width:56px;height:42px;object-fit:cover;border-radius:6px;box-shadow:0 1px 6px rgba(0,0,0,0.06);flex-shrink:0;">
                                    <div>
                                        <a href="#"
                                            style="font-weight:600;color:#222;text-decoration:none;">
                                        Dummy News Title 3                                        </a>
                                        <div style="font-size:0.95rem;color:#888;">
                                            Mar 10, 2024                                        
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
    `;

    mainContainer.innerHTML = renderData;

}












function appendTags(tags) {
    // console.log(tags);

    const tagsListHolder = document.getElementById('post-tags');
    if (!tagsListHolder || !Array.isArray(tags)) return;

    const tagsList = tags.map(tag => `
        <a href="javascript:void(0)" class="uc-link gap-0 dark:text-white">
            ${tag.tag_name} <span class="text-black dark:text-white">,</span>
        </a>
    `).join(' ');

    tagsListHolder.insertAdjacentHTML('beforeend', tagsList);
}




/*=========// set categories news  //==============*/
const insertCatgorizedNews = (newsData, category) => {
    const categoryContainer = document.getElementById('categorized-container');
    const categoryTitle = categoryContainer.querySelector('.category-title');
    const categoryBlock = categoryContainer.querySelector('.block-content');

    categoryTitle.innerHTML = `${category.category_name} <i class="icon-1 fw-bold unicon-chevron-right"></i>`;

    const articles_container = categoryBlock.querySelector(".articles-container");
    if (articles_container != null) articles_container.innerHTML = '';

    newsData.forEach(news => {
        // Create a new div for each news article
        const articleDiv = document.createElement("div");
        articleDiv.innerHTML = `
            <article class="post type-post panel uc-transition-toggle">
                <div class="row child-cols g-2 lg:g-3" data-uc-grid>
                    <div>
                        <div class="post-header panel vstack justify-between gap-1">
                            <h3 class="post-title h6 m-0 text-truncate-2">
                                <a class="text-none hover:text-primary duration-150" href="${NEWS_PATH + news.slug}">
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
                                     data-src="${news.thumbnail ? S3_Path + news.thumbnail : 'assets/images/common/img-fallback.png'}"
                                     alt="${news.headline}"
                                     data-uc-img="loading: lazy">
                            </div>
                            <a href="${NEWS_PATH + news.slug}" class="position-cover"></a>
                        </div>
                    </div>
                </div>
            </article>
        `;
        // Append the article div to the container
        articles_container.appendChild(articleDiv);
    });
};

const insertPostNavigation = (prevNews, nextNews) => {
    const postNewsContainer = document.getElementById('post-navigation');
    const prevContainer = postNewsContainer.querySelector('.prev-container');
    const prevHeadline = prevContainer.querySelector('h6');
    const prevRedirectAnchors = prevContainer.querySelectorAll('a.position-cover');

    const nextContainer = postNewsContainer.querySelector('.next-container');
    const nextHeadline = nextContainer.querySelector('h6');
    const nextRedirectAnchors = nextContainer.querySelectorAll('a.position-cover');


    if (prevNews != null) {
        const prev_translation = prevNews.translations.find(t => t.locale === getLocale()) || prevNews.translations[0];
        prevHeadline.textContent = prev_translation.headline;
        prevRedirectAnchors.forEach(anc => {
            anc.href = NEWS_PATH + prev_translation.slug
        })

    } else {
        prevContainer.classList.add('d-none');
    }

    if (nextNews != null) {
        const next_translation = nextNews.translations.find(t => t.locale === getLocale()) || nextNews.translations[0];
        nextHeadline.textContent = next_translation.headline;
        nextRedirectAnchors.forEach(anc => {
            anc.href = NEWS_PATH + next_translation.slug
        })

    } else {
        nextContainer.classList.add('d-none');
    }



}

function getNewsSlug() {
    const slugElement = document.querySelector("meta[name='news-slug']");
    if (slugElement) {
        return slugElement.getAttribute("content");
    }
    return null;
}

function setNewsSlug(slug) {
    const slugElement = document.querySelector("meta[name='news-slug']");
    if (slugElement) {
        slugElement.setAttribute('content', slug);
        return true;
    }
    return false;
}

/*=========// comment news  //==============*/
const blogCommentContainer = document.getElementById('blog-comment');
const commentFormWrapper = blogCommentContainer.querySelector('#comment-form-wrapper');
const commentCountTag = blogCommentContainer.querySelector('.show-comment-count');


function getNewsId() {
    return document.querySelector("meta[name='news_id']").getAttribute("content");
}
function getUserId() {
    return document.querySelector("meta[name='user_id']").getAttribute("content");
}
function userCanComment() {
    const newsId = getNewsId();
    const userId = getUserId();

    if (newsId === null || newsId === "" || userId === null || userId === "") {
        return false;
    }

    return true;
}
if (!userCanComment()) {
    commentFormWrapper.classList.add('d-none');
} else {
    const commentForm = commentFormWrapper.querySelector('#leaveCommentForm');
    if (commentForm != null) {
        commentForm.addEventListener('submit', async function (event) {
            event.preventDefault();
            const form = event.target;
            const comment = form.comment.value.trim();

            // Basic Validation
            if (!comment) {
                showCommentMessage("Comment Field is required!", "danger");
                return;
            }

            const formData = new FormData(form);
            formData.append('news_id', getNewsId());
            formData.append('user_id', getUserId());

            try {
                // Send Form Data using Fetch API
                const url = hostname + "/comment"

                const response = await fetch(url, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                });

                const result = await response.json(); // Parse JSON response

                if (response.ok) {
                    showCommentMessage(result.message || "Account created successfully!", "success");
                    form.reset(); // Reset form on success
                } else {
                    showCommentMessage(result.error || "An error occurred. Please try again!", "danger");
                }
            } catch (error) {
                console.error(error);
                showCommentMessage("Server error. Please try again later!", "danger");
            }
        });
    }

    function showCommentMessage(message, type) {
        const messageBox = document.getElementById('messageBoxComment');
        messageBox.textContent = message;
        messageBox.className = `alert alert-${type}`;
        messageBox.classList.remove('d-none');

        // Hide message after 3 seconds
        setTimeout(() => messageBox.classList.add('d-none'), 3000);
    }
}

async function getComments() {
    try {
        const url = hostname + `/comments/${getNewsId()}`;
        const resp = await fetch(url);
        if (!resp.ok) {
            err = await resp.json();
        }
        const result = await resp.json();
        renderComments(result);
        commentCountTag.textContent = `Comments (${result.length})`;
    } catch (error) {
        console.error(error);
        // toastr.error(error.message);
    }
}
/// Render Comments and Replies
function renderComments(comments) {
    const commentsContainer = document.getElementById("blog-comment");
    const commentsList = commentsContainer.querySelector("ol");
    commentsList.innerHTML = ""; // Clear existing comments

    comments.forEach((comment) => {
        const commentHTML = createCommentHTML(comment);
        commentsList.innerHTML += commentHTML;
    });
}

// Generate HTML for a Single Comment and Its Replies
function createCommentHTML(comment) {
    const userAvatar = `{{ asset('user/images/avatars') }}/${comment.user_id % 5 + 1}.png`; // Sample avatar logic
    let repliesHTML = "";

    // Generate Replies HTML if Any
    if (comment.replies && comment.replies.length > 0) {
        repliesHTML = `<ol>`;
        comment.replies.forEach((reply) => {
            repliesHTML += createCommentHTML(reply); // Recursive rendering for nested replies
        });
        repliesHTML += `</ol>`;
    }

    // Return the Comment's HTML
    return `
        <li data-comment-id="${comment.id}">
            <div class="avatar">
                <img src="${userAvatar}" alt="">
            </div>
            <div class="comment-info">
                <span class="c_name">${comment.user ? comment.user.name : "Anonymous"}</span>
                <span class="c_date id-color">${new Date(comment.created_at).toLocaleDateString()}</span>
                ${userCanComment() ? `<span class="c_reply"><a href="javascript:void(0)" onclick="replyToComment(${comment.id})">Reply</a></span>` : null}

                <div class="clearfix"></div>
            </div>
            <div class="comment">${comment.content}</div>
            ${repliesHTML}
        </li>
    `;
}

// Add Reply Form and Handle Reply Submission
function replyToComment(commentId) {
    const commentElement = document.querySelector(`[data-comment-id="${commentId}"]`);
    if (commentElement.querySelector(".reply-form")) {
        // If a reply form already exists, remove it
        commentElement.querySelector(".reply-form").remove();
        return;
    }

    // Create a reply form dynamically
    const replyFormHTML = `
        <form class="reply-form" onsubmit="submitReply(event, ${commentId})">
            <textarea class="form-control" rows="2" placeholder="Write a reply..." required></textarea>
            <button type="submit" class="btn btn-sm btn-primary mt-2">Submit</button>
            <button type="button" class="btn btn-sm btn-secondary mt-2" onclick="cancelReply(${commentId})">Cancel</button>
        </form>
    `;
    commentElement.insertAdjacentHTML("beforeend", replyFormHTML);
}

// Cancel Reply Form
function cancelReply(commentId) {
    const commentElement = document.querySelector(`[data-comment-id="${commentId}"]`);
    const replyForm = commentElement.querySelector(".reply-form");
    if (replyForm) {
        replyForm.remove();
    }
}

// Handle Reply Submission
async function submitReply(event, parentId) {
    event.preventDefault();
    const form = event.target;
    const replyContent = form.querySelector("textarea").value;

    try {
        const url = hostname + "/comment-reply";
        const response = await fetch(url, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            },
            body: JSON.stringify({
                parent_id: parentId,
                content: replyContent,
                news_id: getNewsId(), // Assuming getNewsId() provides the news ID
            }),
        });

        if (response.ok) {
            const updatedData = await response.json();
            console.log(updatedData);
            getComments();
            // renderComments(updatedData); // Re-render all comments with the updated data
        } else {
            console.error("Failed to submit reply:", response.statusText);
        }
    } catch (error) {
        console.error("Error submitting reply:", error);
    }
}


/*==============share link of the news ================*/
document.getElementById("shareButton").addEventListener("click", async function () {
    const pageUrl = window.location.href; // Get the current URL

    try {
        // Copy to clipboard
        await navigator.clipboard.writeText(pageUrl);
        // alert("Link copied to clipboard!");

        // Check if the Web Share API is supported
        if (navigator.share) {
            await navigator.share({
                title: document.title,
                text: "Check this out!",
                url: pageUrl
            });
        }
    } catch (error) {
        console.error("Error copying or sharing:", error);
        alert("Failed to copy link.");
    }
});

document.addEventListener("DOMContentLoaded", function () {
    getComments();
    getNewsData(getNewsSlug());

});




