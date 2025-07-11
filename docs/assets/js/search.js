// Initialize search functionality
document.addEventListener('DOMContentLoaded', function() {
  // Initialize variables
  const searchInput = document.getElementById('search-input');
  const searchButton = document.getElementById('search-button');
  const resultsContainer = document.getElementById('results');
  
  // Index for search
  let idx = null;
  let documents = [];
  
  // Fetch search index
  fetch('/search-index.json')
    .then(response => response.json())
    .then(data => {
      documents = data.docs;
      idx = lunr(function() {
        this.ref('url');
        this.field('title', { boost: 10 });
        this.field('content');
        this.field('tags');
        
        // Add documents to the index
        documents.forEach(doc => this.add(doc), this);
      });
    })
    .catch(error => {
      console.error('Error loading search index:', error);
      resultsContainer.innerHTML = '<p>Error loading search. Please try again later.</p>';
    });
  
  // Perform search
  function performSearch(query) {
    if (!idx) return;
    
    // Clear previous results
    resultsContainer.innerHTML = '';
    
    if (!query.trim()) {
      resultsContainer.innerHTML = '<p>Please enter a search term.</p>';
      return;
    }
    
    try {
      // Perform the search
      const results = idx.search(query);
      
      if (results.length === 0) {
        resultsContainer.innerHTML = '<p>No results found. Try different keywords.</p>';
        return;
      }
      
      // Display results
      const resultsList = document.createElement('ul');
      resultsList.className = 'search-results';
      
      results.forEach(result => {
        const doc = documents.find(d => d.url === result.ref);
        if (!doc) return;
        
        const li = document.createElement('li');
        const link = document.createElement('a');
        link.href = doc.url;
        link.textContent = doc.title || 'Untitled';
        
        const excerpt = document.createElement('p');
        excerpt.innerHTML = getExcerpt(doc.content, query);
        
        li.appendChild(link);
        li.appendChild(excerpt);
        resultsList.appendChild(li);
      });
      
      resultsContainer.appendChild(resultsList);
    } catch (error) {
      console.error('Search error:', error);
      resultsContainer.innerHTML = '<p>An error occurred during search. Please try again.</p>';
    }
  }
  
  // Helper function to get excerpt with highlighted terms
  function getExcerpt(text, query) {
    if (!text) return '';
    
    // Simple excerpt logic - can be enhanced
    const words = query.toLowerCase().split(/\s+/);
    let excerpt = text.substring(0, 200);
    
    // Highlight search terms
    words.forEach(word => {
      if (word.length < 3) return; // Skip short words
      const regex = new RegExp(`(${word})`, 'gi');
      excerpt = excerpt.replace(regex, '<span class="highlight">$1</span>');
    });
    
    return excerpt + (text.length > 200 ? '...' : '');
  }
  
  // Event listeners
  searchButton.addEventListener('click', () => performSearch(searchInput.value.trim()));
  searchInput.addEventListener('keyup', (e) => {
    if (e.key === 'Enter') {
      performSearch(searchInput.value.trim());
    }
  });
  
  // Focus search input on page load
  if (searchInput) searchInput.focus();
});
