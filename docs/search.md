---
layout: page
title: Search
description: Search the Islam Skin & IslamDashboard documentation
permalink: /search/
---

# Search Documentation

<div id="search-container">
  <div class="search-box">
    <input type="text" id="search-input" placeholder="Search documentation..." autofocus>
    <button id="search-button">Search</button>
  </div>
  
  <div id="results-container">
    <ul id="results"></ul>
  </div>
</div>

<!-- Lunr.js for search -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/lunr.js/2.3.9/lunr.min.js"></script>
<script src="{{ '/assets/js/search.js' | relative_url }}"></script>

<style>
.search-box {
  margin: 2rem 0;
  display: flex;
  gap: 0.5rem;
}

#search-input {
  flex: 1;
  padding: 0.5rem;
  border: 1px solid #ddd;
  border-radius: 4px;
  font-size: 1rem;
}

#search-button {
  padding: 0.5rem 1rem;
  background-color: #2c3e50;
  color: white;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

#search-button:hover {
  background-color: #1a252f;
}

#results-container {
  margin-top: 2rem;
}

#results li {
  margin-bottom: 1.5rem;
  padding-bottom: 1rem;
  border-bottom: 1px solid #eee;
}

#results a {
  color: #2c3e50;
  text-decoration: none;
  font-weight: bold;
  font-size: 1.1rem;
}

#results a:hover {
  text-decoration: underline;
}

#results p {
  margin: 0.5rem 0 0;
  color: #555;
}

.highlight {
  background-color: #fff3cd;
  padding: 0.1rem 0.2rem;
  border-radius: 2px;
}
</style>
