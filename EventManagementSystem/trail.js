document.addEventListener("DOMContentLoaded", () => {
    const searchInput = document.getElementById("search-input");
  
    searchInput.addEventListener("input", async () => {
      const query = searchInput.value.trim();
  
      // Check if input is not empty
      if (query) {
        const suggestions = await fetchSearchSuggestions(query);
        displaySuggestions(suggestions);
      } else {
        clearSuggestions();
      }
    });
  });
  
  // Function to fetch search suggestions based on input
  async function fetchSearchSuggestions(query) {
    try {
      // Replace `YOUR_API_ENDPOINT` with your actual search endpoint
      const response = await fetch(`YOUR_API_ENDPOINT?q=${encodeURIComponent(query)}`);
      const data = await response.json();
      return data.suggestions;  // Ensure this matches the structure of your data
    } catch (error) {
      console.error("Error fetching suggestions:", error);
      return [];
    }
  }
  
  // Function to display suggestions
  function displaySuggestions(suggestions) {
    // Logic to display suggestions (e.g., in a dropdown below the search input)
    const suggestionContainer = document.getElementById("suggestions");
  
    // Clear any previous suggestions
    suggestionContainer.innerHTML = '';
  
    suggestions.forEach(suggestion => {
      const suggestionItem = document.createElement("div");
      suggestionItem.classList.add("suggestion-item");
      suggestionItem.textContent = suggestion;
      suggestionItem.addEventListener("click", () => {
        searchInput.value = suggestion;
        clearSuggestions();
        performSearch();
      });
      suggestionContainer.appendChild(suggestionItem);
    });
  }
  
  // Function to clear suggestions
  function clearSuggestions() {
    const suggestionContainer = document.getElementById("suggestions");
    suggestionContainer.innerHTML = '';
  }
  
  // Function to handle search action
  function performSearch() {
    const query = document.getElementById("search-input").value;
    // Add logic for what happens when the search is performed, such as displaying results
  }
  