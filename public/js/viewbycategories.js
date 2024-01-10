function createQuestionBox(
  profilePicUrl,
  userProfile,
  questionTitle,
  questionDescription
) {
  const questionBox = document.createElement("div");
  questionBox.classList.add("post-box");

  // User Profile Section
  const profileSection = document.createElement("div");
  profileSection.classList.add("profile-section");

  const profilePicture = document.createElement("div");
  profilePicture.classList.add("profile-picture");
  const img = document.createElement("img");
  img.src = profilePicUrl;
  img.alt = "User Profile Picture";
  profilePicture.appendChild(img);

  const profileName = document.createElement("p");
  profileName.textContent = userProfile;

  profileSection.appendChild(profilePicture);
  profileSection.appendChild(profileName);

  // Title Section
  const titleSection = document.createElement("div");
  titleSection.classList.add("title-section");
  const title = document.createElement("h3");
  title.textContent = questionTitle;
  titleSection.appendChild(title);

  // Question Description Section
  const descriptionSection = document.createElement("div");
  descriptionSection.classList.add("description-section");
  const description = document.createElement("p");
  description.textContent = questionDescription;
  descriptionSection.appendChild(description);

  // Like and Answer Buttons
  const postActions = document.createElement("div");
  postActions.classList.add("post-actions");

  const likeButton = document.createElement("div");
  likeButton.classList.add("like-btn");
  // Create the SVG container
  const svgContainer = document.createElement("div");
  svgContainer.classList.add("svg-container");
  svgContainer.innerHTML = `
        <input type="checkbox" id="checkbox" />
        
        <svg id="heart-svg" viewBox="467 392 58 57" xmlns="http://www.w3.org/2000/svg">
        <g id="Group" fill="none" fill-rule="evenodd" transform="translate(467 392)">
            <path
                d="M29.144 20.773c-.063-.13-4.227-8.67-11.44-2.59C7.63 28.795 28.94 43.256 29.143 43.394c.204-.138 21.513-14.6 11.44-25.213-7.214-6.08-11.377 2.46-11.44 2.59z"
                id="heart" fill="#AAB8C2" />
            <circle id="main-circ" fill="#E2264D" opacity="0" cx="29.5" cy="29.5" r="1.5" />
    
            <g id="grp7" opacity="0" transform="translate(7 6)">
                <circle id="oval1" fill="#9CD8C3" cx="2" cy="6" r="2" />
                <circle id="oval2" fill="#8CE8C3" cx="5" cy="2" r="2" />
            </g>
    
            <g id="grp6" opacity="0" transform="translate(0 28)">
                <circle id="oval1" fill="#CC8EF5" cx="2" cy="7" r="2" />
                <circle id="oval2" fill="#91D2FA" cx="3" cy="2" r="2" />
            </g>
    
            <g id="grp3" opacity="0" transform="translate(52 28)">
                <circle id="oval2" fill="#9CD8C3" cx="2" cy="7" r="2" />
                <circle id="oval1" fill="#8CE8C3" cx="4" cy="2" r="2" />
            </g>
    
            <g id="grp2" opacity="0" transform="translate(44 6)">
                <circle id="oval2" fill="#CC8EF5" cx="5" cy="6" r="2" />
                <circle id="oval1" fill="#CC8EF5" cx="2" cy="2" r="2" />
            </g>
    
            <g id="grp5" opacity="0" transform="translate(14 50)">
                <circle id="oval1" fill="#91D2FA" cx="6" cy="5" r="2" />
                <circle id="oval2" fill="#91D2FA" cx="2" cy="2" r="2" />
            </g>
    
            <g id="grp4" opacity="0" transform="translate(35 50)">
                <circle id="oval1" fill="#F48EA7" cx="6" cy="5" r="2" />
                <circle id="oval2" fill="#F48EA7" cx="2" cy="2" r="2" />
            </g>
    
            <g id="grp1" opacity="0" transform="translate(24)">
                <circle id="oval1" fill="#9FC7FA" cx="2.5" cy="3" r="2" />
                <circle id="oval2" fill="#9FC7FA" cx="7.5" cy="2" r="2" />
            </g>
        </g>
    </svg>
      `;

  likeButton.appendChild(svgContainer);

  const answerButton = document.createElement("button");
  answerButton.textContent = "Answer 🔽";
  answerButton.classList = "ans-btn";

  postActions.appendChild(likeButton);
  postActions.appendChild(answerButton);

  // Share Button
  const shareButton = document.createElement("div");
  shareButton.classList.add("share-button");
  const shareBtn = document.createElement("img");
  shareBtn.src =
    "https://cdn2.iconfinder.com/data/icons/line-drawn-social-media/31/share-1024.png";
  shareBtn.height = 30;
  shareBtn.width = 30;

  shareButton.appendChild(shareBtn);

  // Append all sections to the question box
  questionBox.appendChild(profileSection);
  questionBox.appendChild(titleSection);
  questionBox.appendChild(descriptionSection);
  questionBox.appendChild(postActions);
  questionBox.appendChild(shareButton);

  return questionBox;
}

// Create and append question boxes manually
document.addEventListener("DOMContentLoaded", function () {
  const questionContainer = document.querySelector(".content");

  // Question 1
  const questionBox1 = createQuestionBox(
    "nycto.jpg",
    "User Profile 1",
    "Title of Question 1",
    "Description of Question 1"
  );
  questionContainer.appendChild(questionBox1);

  // Question 2
  const questionBox2 = createQuestionBox(
    "nycto.jpg",
    "User Profile 2",
    "Title of Question 2",
    "Description of Question 2"
  );
  questionContainer.appendChild(questionBox2);
});
