<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
      crossorigin="anonymous"
    />
    <link
      href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp"
      rel="stylesheet"
    />
    <style>
        body {
  margin: 0;
  padding: 0;
  height: 100vh;
  background-color: rgb(24, 24, 24);
}

.border-gray {
  border-style: solid;
  border-color: rgb(221, 221, 221);
  border-width: 1px;
}
.form-control {
  font-size: 15px;
  color: black;
}

.text-gray-dark {
  color: rgb(117, 115, 115);
}
.text-gray-darker {
  color: rgb(83, 82, 82);
}

.text-main-color {
  color: var(--main-color);
}

.bg-main-color {
  background-color: var(--main-color);
}

.bg-second-color {
  background-color: rgb(233, 233, 233);
}
.nav-link svg {
  width: 45px;
  height: 33px;
  padding-left: 7px;
  padding-right: 7px;
}

.profile {
  width: 40px;
  height: 40px;
  padding: 0;
}

.post-profile {
  width: 55px;
  height: 55px;
  padding: 7px;
}

.nav-link:hover {
  background-color: rgba(247, 247, 247, 0.566);
  border-radius: 5px;
}

#button1 {
  border-bottom-left-radius: var(--dropdown-radius);
  border-top-left-radius: var(--dropdown-radius);
}

#button1:hover {
  background-color: var(--main-color-darker);
}

#button2 {
  border-bottom-right-radius: var(--dropdown-radius);
  border-top-right-radius: var(--dropdown-radius);
  border-left-style: solid;
  border-left-color: rgb(83, 83, 83);
  border-width: 1px;
  color: white;
}

#left-list {
  margin-left: 20px;
}

#left-list a {
  text-decoration: none;
  padding: 5px;
  color: gray;
  font-size: 13px;
}

#left-list a:hover {
  background-color: rgb(233, 233, 233);
  border-radius: 5px;
}

#left-list img {
  width: 20px;
  height: 20px;
  border-radius: 5px;
}

.hover-dark:hover {
  background-color: rgb(233, 233, 233);
  border-radius: 5px;
}

.left-button {
  border-bottom-left-radius: var(--dropdown-radius);
  border-top-left-radius: var(--dropdown-radius);
}

.right-button {
  border-bottom-right-radius: var(--dropdown-radius);
  border-top-right-radius: var(--dropdown-radius);
}

.post-button-bg {
  background-color: rgb(255, 255, 255);
}

.post-button:hover {
  background-color: rgb(238, 238, 238);
}
.logo {
  background-image: url("/USER/images/Askify\ \(2\).png");
  height: 45px;
  width: 100px;
  background-size: cover;
}
.navbar {
  background-image: linear-gradient(
    to right,
    rgb(3, 192, 205),
    rgb(122, 46, 231)
  );
  height: 60px;
}
.navbar-links {
  display: flex;
  justify-content: center;
  align-items: center;
}
.navbar-links svg {
  margin-right: 10px;
}

.search-profile {
  display: flex;
  justify-content: center;
  align-items: center;
}

.posts-mid-section .mid-section-header {
  padding: 1em;
}

.posts-mid-section .post-container {
  padding: 0.5em;
}
.modal {
  display: none;
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.4);
  align-items: center;
  justify-content: center;
}

.modal-content {
  width: 500px;
  color: white;
  display: flex;
  flex-direction: column;
  background-color: black;
  padding: 50px;
  border-radius: 15px;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
  text-align: center;
  position: relative;
  /* Added this line to establish a positioning context */
}

h1 {
  margin: 0 0 20px;
  /* Added margin at the bottom */
}

.close-btn {
  position: absolute;
  top: 10px;
  right: 15px;
  font-size: 24px;
  cursor: pointer;
  color: #888;
}

/* ... (remaining CSS code) ... */
textarea {
  outline: none;
  resize: none;
  width: 30em;
  height: 120px;
  margin-top: 15px;
  padding: 10px;
  background-color: #f0f0f0;
  border: 1px solid #ccc;
  border-radius: 8px;
  font-size: 16px;
}

/* ... (your existing CSS rules) ... */

label.anonymous-label {
  display: block;
  margin-top: 15px;
  font-size: 14px;
  color: #666;
  position: relative; /* Add this line to establish a positioning context */
}

label.anonymous-label::before {
  content: "If You Check this textbox your identity will not reveal"; /* Text for the tooltip */
  position: absolute;
  top: -28px; /* Adjust this value to position the tooltip */
  left: 115px;
  display: none;
  background-color: black;
  color: red;
  padding: 5px 10px;
  border-radius: 4px;
  font-size: 12px;
  white-space: nowrap;
}

label.anonymous-label:hover::before {
  display: block;
}

input[type="checkbox"] {
  margin-right: 8px;
}

button {
  margin-top: 15px;
  padding: 10px 20px;
  color: white;
  background-color: #007bff;
  border: none;
  font-size: 16px;
  transition: background-color 0.3s ease;
  cursor: pointer;
}

button:hover {
  background-color: #0056b3;
}

.tab-container {
  display: flex;
  justify-content: center;
  margin-bottom: 20px;
}

.tab {
  padding: 10px 20px;
  background-color: transparent;
  border: none;
  cursor: pointer;
  font-size: 16px;
  border-bottom: 3px solid transparent;
  transition: border-bottom 0.3s ease;
}

.tab:focus {
  outline: none;
}

.tab.selected {
  border-bottom: 3px solid #007bff;
}

.tab-content-container {
  overflow: hidden;
  max-height: 400px;
  transition: max-height 0.3s ease;
}

.tab-content {
  display: none;
  padding: 20px 0;
}

.tab-content.active {
  display: block;
}

    </style>
    <title>Askify</title>
  </head>
  
  <body>
    <nav class="navbar navbar-expand-md navbar-light border-bottom p-0 ps-5">
      <div class="container">
        <a class="navbar-brand" href="#">
          <div class="logo"></div>
        </a>
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-links">
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav">
              <li class="nav-item border-main-color">
                <a class="nav-link" href="#">
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="16"
                    height="16"
                    fill="black"
                    class="bi bi-house"
                    viewBox="0 0 16 16"
                  >
                    <path
                      d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L2 8.207V13.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V8.207l.646.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.707 1.5ZM13 7.207V13.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V7.207l5-5 5 5Z"
                    />
                  </svg>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">
                  <svg
                    class="text-muted"
                    xmlns="http://www.w3.org/2000/svg"
                    enable-background="new 0 0 24 24"
                    viewBox="0 0 24 24"
                    fill="black"
                  >
                    <g>
                      <path d="M0,0h24v24H0V0z" fill="none" />
                    </g>
                    <g>
                      <path
                        d="M16,3H5C3.9,3,3,3.9,3,5v14c0,1.1,0.9,2,2,2h14c1.1,0,2-0.9,2-2V8L16,3z M19,19H5V5h10v4h4V19z M7,17h10v-2H7V17z M12,7H7 v2h5V7z M7,13h10v-2H7V13z"
                      />
                    </g>
                  </svg>
                  <!-- For Notification dot or numerics -->
                  <!-- <span class="position-relative me-auto">
                                <span
                                    class="position-absolute top-0 start-100 translate-middle p-1 bg-danger border border-light rounded-circle">
                                    <span class="visually-hidden">New alerts</span>
                                </span>
                            </span> -->
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">
                  <svg
                    class="text-muted"
                    xmlns="http://www.w3.org/2000/svg"
                    enable-background="new 0 0 24 24"
                    viewBox="0 0 24 24"
                    fill="black"
                  >
                    <rect fill="none" height="24" width="24" />
                    <path
                      d="M3,10h11v2H3V10z M3,8h11V6H3V8z M3,16h7v-2H3V16z M18.01,12.87l0.71-0.71c0.39-0.39,1.02-0.39,1.41,0l0.71,0.71 c0.39,0.39,0.39,1.02,0,1.41l-0.71,0.71L18.01,12.87z M17.3,13.58l-5.3,5.3V21h2.12l5.3-5.3L17.3,13.58z"
                    />
                  </svg>
                  <!-- For Notification dot or numerics -->
                  <!-- <span class="position-relative">
                                <span
                                    class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                    2
                                    <span class="visually-hidden">unread 
                                        
                                    </span>
                                </span>
                            </span> -->
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">
                  <svg
                    class="text-muted"
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 24 24"
                    fill="black"
                  >
                    <path d="M0 0h24v24H0V0z" fill="none" />
                    <path
                      d="M9 13.75c-2.34 0-7 1.17-7 3.5V19h14v-1.75c0-2.33-4.66-3.5-7-3.5zM4.34 17c.84-.58 2.87-1.25 4.66-1.25s3.82.67 4.66 1.25H4.34zM9 12c1.93 0 3.5-1.57 3.5-3.5S10.93 5 9 5 5.5 6.57 5.5 8.5 7.07 12 9 12zm0-5c.83 0 1.5.67 1.5 1.5S9.83 10 9 10s-1.5-.67-1.5-1.5S8.17 7 9 7zm7.04 6.81c1.16.84 1.96 1.96 1.96 3.44V19h4v-1.75c0-2.02-3.5-3.17-5.96-3.44zM15 12c1.93 0 3.5-1.57 3.5-3.5S16.93 5 15 5c-.54 0-1.04.13-1.5.35.63.89 1 1.98 1 3.15s-.37 2.26-1 3.15c.46.22.96.35 1.5.35z"
                    />
                  </svg>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">
                  <svg
                    class="text-muted"
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 24 24"
                    fill="black"
                  >
                    <path d="M0 0h24v24H0V0z" fill="none" />
                    <path
                      d="M12 22c1.1 0 2-.9 2-2h-4c0 1.1.9 2 2 2zm6-6v-5c0-3.07-1.63-5.64-4.5-6.32V4c0-.83-.67-1.5-1.5-1.5s-1.5.67-1.5 1.5v.68C7.64 5.36 6 7.92 6 11v5l-2 2v1h16v-1l-2-2zm-2 1H8v-6c0-2.48 1.51-4.5 4-4.5s4 2.02 4 4.5v6z"
                    />
                  </svg>
                </a>
              </li>
            </ul>
          </div>
        </div>

        <div class="search-profile">
          <form class="d-flex">
            <input
              class="form-control me-2 search-icon"
              type="search"
              placeholder="Search Anything Here.."
              aria-label="Search"
            />
          </form>
          <ul class="navbar-nav px-3">
            <li class="nav-item">
              <a class="nav-link" href="#">
                <img
                  class="profile rounded-circle"
                  src="/USER/images/NYCTOPHILE.png"
                />
              </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <div class="pt-4 bgcolors">
      <div class="container mb-5">
        <div class="row">
          <!--categories -->
          <div id="left-list" class="col-2 d-flex flex-column">
            <a href="#">
              <span class="position-relative me-auto">
                <img src="src/pic1.jpg" />

                <span
                  class="position-absolute top-0 start-50 translate-middle ms-2 p-1 bg-danger border border-light rounded-circle"
                >
                  <span class="visually-hidden">New alerts</span>
                </span>
              </span>
              <span>Category 1</span>
            </a>
            <a href="#">
              <img src="src/pic1.jpg" />
              <span>Category 2</span>
            </a>
            <a href="#">
              <img src="src/pic1.jpg" />
              <span>Category 3</span>
            </a>
            <a href="#">
              <img src="src/pic1.jpg" />
              <span>Category 4</span>
            </a>
            <a href="#">
              <img src="src/pic1.jpg" />
              <span>Category 5</span>
            </a>
            <a href="#">
              <img src="src/pic1.jpg" />
              <span>Category 6</span>
            </a>
            <a href="#">
              <img src="src/pic1.jpg" />
              <span>Category 7</span>
            </a>
          </div>

          <!-- middle section -->
          <div class="posts-mid-section col-7">
            <div class="bg-white border-gray mid-section-header">

              <div class="row text-gray-darker pb-2 ps-4 pe-4">
                <div class="col text-center border-end hover-dark">
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    height="24px"
                    viewBox="0 0 24 24"
                    width="24px"
                    fill="currentColor"
                  >
                    <path d="M0 0h24v24H0V0z" fill="none" />
                    <path
                      d="M19 2H5c-1.11 0-2 .9-2 2v14c0 1.1.89 2 2 2h4l3 3 3-3h4c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm0 16h-4.83l-.59.59L12 20.17l-1.59-1.59-.58-.58H5V4h14v14zm-8-3h2v2h-2zm1-8c1.1 0 2 .9 2 2 0 2-3 1.75-3 5h2c0-2.25 3-2.5 3-5 0-2.21-1.79-4-4-4S8 6.79 8 9h2c0-1.1.9-2 2-2z"
                    />
                  </svg>
                  <span>Ask</span>
                </div>
                <div class="col text-center border-end hover-dark">
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    enable-background="new 0 0 24 24"
                    height="24px"
                    viewBox="0 0 24 24"
                    width="24px"
                    fill="currentColor"
                  >
                    <rect fill="none" height="24" width="24" />
                    <path
                      d="M3,10h11v2H3V10z M3,8h11V6H3V8z M3,16h7v-2H3V16z M18.01,12.87l0.71-0.71c0.39-0.39,1.02-0.39,1.41,0l0.71,0.71 c0.39,0.39,0.39,1.02,0,1.41l-0.71,0.71L18.01,12.87z M17.3,13.58l-5.3,5.3V21h2.12l5.3-5.3L17.3,13.58z"
                    />
                  </svg>
                  <span>Answer</span>
                </div>
                <div id="openModalBtn" class="col text-center hover-dark">
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    height="24px"
                    viewBox="0 0 24 24"
                    width="24px"
                    fill="currentColor"
                  >
                    <path d="M0 0h24v24H0V0z" fill="none" />
                    <path
                      d="M14.06 9.02l.92.92L5.92 19H5v-.92l9.06-9.06M17.66 3c-.25 0-.51.1-.7.29l-1.83 1.83 3.75 3.75 1.83-1.83c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.2-.2-.45-.29-.71-.29zm-3.6 3.19L3 17.25V21h3.75L17.81 9.94l-3.75-3.75z"
                    />
                  </svg>
                  <span>Post</span>
                </div>
              </div>
            </div>
            <div id="modal" class="modal">
              <div class="modal-content">
                <div class="tab-container">
                  <button class="tab selected" id="askQuestionTab">
                    Ask a Question
                  </button>
                  <button class="tab" id="createPostTab">Create Post</button>
                </div>
                <div class="tab-content-container">
                  <div class="tab-content active" id="askQuestionContent">
                    <h3 align="left">Ask a Question</h3>
                    <hr />
                    <form action="/save-question" method="post">
                      <span class="close-btn" id="closeModalBtn">&times;</span>
                      <textarea
                        id="questionInput"
                        placeholder="Enter your question..."
                        name="question_text"
                      ></textarea>
                      <label for="anonymousCheckbox" class="anonymous-label">
                        <input type="checkbox"name="is_anonymous" id="anonymousCheckbox" /> Post
                        Anonymously
                      </label>
                      <button id="submitQuestionBtn">Submit</button>
                    </form>
                  </div>
                  <div class="tab-content" id="createPostContent">
                    <h3 align="left">Create Post</h3>
                    <hr />
                    <form action="/save-post" method="post">
                      <span class="close-btn" id="closeModalBtn">&times;</span>
                      <textarea
                        name="post_caption"
                        id="postInput"
                        placeholder="Enter your post..."
                      ></textarea>
                      <input type="file" name="post_image" id="mediaUpload" accept="image/*" />
                      <button id="submitPostBtn">Submit</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            <!-- info: dynamically adding posts here from `loadMorePosts()` function -->

            <!-- suggestion: show a loader when posts are begin fetched from server -->
          </div>

          <!-- suggestion: make this fixed for better user experience -->
          <div class="col">
            <ul class="list-group">
              <li class="list-group-item d-flex justify-content-between">
                <div class="">
                  <img
                    src="src/pic1.jpg"
                    width="20"
                    height="20"
                    class="rounded"
                  />
                </div>
                <div class="ps-2 lh-1">
                  <div class="fw-bold">Advance AI</div>
                  <div class="text-secondary fw-light">
                    A space for advances in AI, Blockchaine, Science, Space and
                    startup
                  </div>
                </div>
              </li>
              <li class="list-group-item d-flex justify-content-between">
                <div class="">
                  <img
                    src="src/pic1.jpg"
                    width="20"
                    height="20"
                    class="rounded"
                  />
                </div>
                <div class="ps-2 lh-1">
                  <div class="fw-bold">Advance AI</div>
                  <div class="text-secondary fw-light">
                    A space for advances in AI, Blockchaine, Science, Space and
                    startup
                  </div>
                </div>
              </li>
              <li class="list-group-item d-flex justify-content-between">
                <div class="">
                  <img
                    src="src/pic1.jpg"
                    width="20"
                    height="20"
                    class="rounded"
                  />
                </div>
                <div class="ps-2 lh-1">
                  <div class="fw-bold">Advance AI</div>
                  <div class="text-secondary fw-light">
                    A space for advances in AI, Blockchaine, Science, Space and
                    startup
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </body>
  <script>
    const openModalBtn = document.getElementById("openModalBtn");
const modal = document.getElementById("modal");
const closeModalBtns = document.querySelectorAll(".close-btn");
const askQuestionTab = document.getElementById("askQuestionTab");
const createPostTab = document.getElementById("createPostTab");
const askQuestionContent = document.getElementById("askQuestionContent");
const createPostContent = document.getElementById("createPostContent");
const tabContentContainer = document.querySelector(".tab-content-container");

openModalBtn.addEventListener("click", () => {
  modal.style.display = "flex";
});

closeModalBtns.forEach((closeBtn) => {
  closeBtn.addEventListener("click", () => {
    modal.style.display = "none";
  });
});

askQuestionTab.addEventListener("click", () => {
  askQuestionContent.classList.add("active");
  createPostContent.classList.remove("active");
  tabContentContainer.style.maxHeight = askQuestionContent.offsetHeight + "px";
  askQuestionTab.classList.add("selected");
  createPostTab.classList.remove("selected");
});

createPostTab.addEventListener("click", () => {
  askQuestionContent.classList.remove("active");
  createPostContent.classList.add("active");
  tabContentContainer.style.maxHeight = createPostContent.offsetHeight + "px";
  createPostTab.classList.add("selected");
  askQuestionTab.classList.remove("selected");
});

function loadMorePosts() {
  const newPosts = [
    // fetch this data from a server
    {
      firstName: "user 1",
      pfpURL: "NYCTOPHILE.png",
      jobTitle: "Job title",
      jobPosition: "position",
      title: "Post Title 1",
      content:
        "This is the content of Post 1. Lorem ipsum dolor sit amet, consectetur adipiscing elit.",
    },
    {
      firstName: "user 2",
      pfpURL: "NYCTOPHILE.png",
      jobTitle: "Job title",
      jobPosition: "position",
      title: "Post Title 2",
      content:
        "This is the content of Post 2. Lorem ipsum dolor sit amet, consectetur adipiscing elit.",
    },
    {
      firstName: "user 3",
      pfpURL: "NYCTOPHILE.png",
      jobTitle: "Job title",
      jobPosition: "position",
      title: "Post Title 3",
      content:
        "This is the content of Post 3. Lorem ipsum dolor sit amet, consectetur adipiscing elit.",
    },
    {
      firstName: "user 4",
      pfpURL: "NYCTOPHILE.png",
      jobTitle: "Job title",
      jobPosition: "position",
      title: "Post Title 4",
      content:
        "This is the content of Post 4. Lorem ipsum dolor sit amet, consectetur adipiscing elit.",
    },
    // add more posts here

    // suggestion: fetch a specific amount of posts (5 - 10), when user scrolls then fetch (5 - 10) more...
  ];

  // dynamically add the new posts to the "posts-mid-section" element
  const postsMidSection = document.querySelector(".posts-mid-section");
  newPosts.forEach((post) => {
    const postHTML = `<div class="bg-white border-gray mt-4 post-container">
    <div class="d-flex pt-2 post-header-container">
        <div class="col d-flex">
            <img class="post-profile rounded-circle " src="${post.pfpURL}">
            <div class="d-flex flex-column">
                <span class="fw-bold fs-6">${post.firstName}</span>
                <span class="text-gray-darker fs-6">${post.jobTitle} | ${post.jobPosition}</span>
            </div>
        </div>
        <div class="p-2 text-gray-darker">
            <button class="btn rounded-circle hover-dark p-1">
                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24"
                    width="24px" fill="currentColor">
                    <path d="M0 0h24v24H0V0z" fill="none" />
                    <path
                        d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12 19 6.41z" />
                </svg>
            </button>
        </div>
    </div>
    <div class="post-body pt-2 ps-3">
        <div class="post-title fw-bold">
            <a class="text-decoration-none text-black" href="#">
                ${post.title}
            </a>
        </div>
        <div class="post-text pt-1">
            ${post.content}
        </div>
    </div>
    <div class="post-image pt-2">
        <img class="img-fluid" src="src/post_image.jpg">
    </div>
    <div class="post-footer p-2">
        <div class="btn-group" role="group" aria-label="Basic example">
            <button type="button"
                class="left-button post-button bg-second-color border-0 text-black p-1">
                <img src="src/up.png" width="20" class="ms-2">
                15
            </button>
            <button type="button"
                class="right-button post-button bg-second-color border-0 text-black p-1">
                <img src="src/down.png" width="20" class="me-2">

            </button>
        </div>
        <button type="button"
            class="post-button post-button-bg border-0 rounded-circle text-black p-1">
            <img src="src/refresh.png" width="20" class="">
            1
        </button>
        <button type="button"
            class="post-button post-button-bg border-0 rounded-circle text-black p-1">
            <img src="src/comment.png" width="25" class="p-1">
            123
        </button>
    </div>
</div>`;
    postsMidSection.insertAdjacentHTML("beforeend", postHTML);
  });
}

// // set up the Intersection Observer
// const loadingIndicator = document.querySelector(".loading-indicator");

// const observer = new IntersectionObserver(
//   (entries, observer) => {
//     entries.forEach((entry) => {
//       if (entry.isIntersecting) {
//         loadMorePosts();
//         // stop observing once the loading indicator is triggered
//         observer.unobserve(loadingIndicator);
//       }
//     });
//   },
//   {
//     threshold: 0.5,
//   }
// );

// observer.observe(loadingIndicator);

loadMorePosts();

  </script>
</html>
