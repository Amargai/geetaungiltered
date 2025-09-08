<?php
$posts = glob("posts/*.html");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Geeta Unfiltered - Official</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background: var(--bg);
      color: var(--text);
    }
    :root {
      --bg: #ffffff;
      --text: #222222;
      --primary: #5c3d99;
    }
    .dark {
      --bg: #121212;
      --text: #eaeaea;
      --primary: #bb86fc;
    }
    header {
      background: var(--primary);
      color: white;
      padding: 1rem;
      text-align: center;
    }
    nav a {
      margin: 0 1rem;
      color: white;
      text-decoration: none;
      font-weight: bold;
    }
    section {
      padding: 2rem 1rem;
      max-width: 900px;
      margin: auto;
    }
    .hero {
      text-align: center;
      padding: 3rem 1rem;
      background: #f4f4f4;
    }
    .hero h1 { font-size: 2.5rem; margin-bottom: 0.5rem; }
    .post-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 1rem;
    }
    .post-item {
      border: 1px solid #ddd;
      padding: 1rem;
      border-radius: 8px;
      background: var(--bg);
    }
    footer {
      text-align: center;
      padding: 1rem;
      background: #f1f1f1;
      margin-top: 2rem;
    }
    button, input, textarea {
      padding: 0.5rem;
      border-radius: 5px;
      border: 1px solid #ccc;
    }
    #search {
      display: block;
      margin: 1rem auto;
      padding: 0.5rem;
      width: 80%;
      max-width: 400px;
    }
  </style>
</head>
<body>
  <header>
    <h1>Geeta Unfiltered</h1>
    <nav>
      <a href="#about">About</a>
      <a href="#posts">Posts</a>
      <a href="#press">Press</a>
      <a href="#contact">Contact</a>
    </nav>
    <button id="modeToggle">🌙</button>
  </header>

  <section class="hero">
    <h1>Wisdom of the Bhagavad Geeta</h1>
    <p>Unfiltered. Relevant. For today’s world.</p>
  </section>

  <section id="about">
    <h2>About Geeta Unfiltered</h2>
    <p>Geeta Unfiltered is a humble initiative to share timeless wisdom from the Bhagavad Geeta. 
    We simplify complex verses into practical lessons for modern life, without filters or sugar-coating.</p>
  </section>

  <section id="posts">
    <h2>Latest Posts</h2>
    <input type="text" id="search" placeholder="Search posts..." onkeyup="filterPosts()">
    <div class="post-grid">
      <?php
        if ($posts) {
          foreach ($posts as $post) {
            $title = basename($post, ".html");
            $excerpt = substr(strip_tags(file_get_contents($post)), 0, 120) . '...';
            echo "<article class='post-item'><h3><a href='$post'>" . ucfirst(str_replace('-', ' ', $title)) . "</a></h3><p>$excerpt</p></article>";
          }
        } else {
          echo "<p>No posts yet. Start writing!</p>";
        }
      ?>
    </div>
  </section>

  <section id="press">
    <h2>Press & Mentions</h2>
    <p>Coming soon: links to articles, guest blogs, and media mentions that highlight Geeta Unfiltered.</p>
  </section>

  <section id="contact">
    <h2>Contact</h2>
    <p>Want to collaborate or share feedback? Reach us:</p>
    <p>Email: <a href="mailto:contact@geetaunfiltered.com">contact@geetaunfiltered.com</a></p>
    <p>Instagram: <a href="https://instagram.com/geeta.unfiltered" target="_blank">@geeta.unfiltered</a></p>
  </section>

  <footer>
    <p>&copy; <?php echo date("Y"); ?> Geeta Unfiltered. All rights reserved.</p>
  </footer>

  <script>
    function filterPosts() {
      let input = document.getElementById('search').value.toLowerCase();
      let posts = document.getElementsByClassName('post-item');
      for (let i = 0; i < posts.length; i++) {
        let text = posts[i].innerText.toLowerCase();
        posts[i].style.display = text.includes(input) ? "block" : "none";
      }
    }
    const toggle = document.getElementById("modeToggle");
    const body = document.body;
    if (localStorage.getItem("theme") === "dark") {
      body.classList.add("dark");
    }
    toggle.addEventListener("click", () => {
      body.classList.toggle("dark");
      localStorage.setItem("theme", body.classList.contains("dark") ? "dark" : "light");
    });
  </script>
</body>
</html>
