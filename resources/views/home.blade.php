@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="flex-container">
            <div class="Left">
                <svg id="chat-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chat-square-text-fill" viewBox="0 0 16 16">
                    <path d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2h-2.5a1 1 0 0 0-.8.4l-1.9 2.533a1 1 0 0 1-1.6 0L5.3 12.4a1 1 0 0 0-.8-.4H2a2 2 0 0 1-2-2zm3.5 1a.5.5 0 0 0 0 1h9a.5.5 0 0 0 0-1zm0 2.5a.5.5 0 0 0 0 1h9a.5.5 0 0 0 0-1zm0 2.5a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1z"/>
                </svg>
                <svg id="person-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-lines-fill" viewBox="0 0 16 16">
                    <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5 6s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zM11 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5m.5 2.5a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1zm2 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1zm0 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1z"/>
                </svg>
                <svg id="plus-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-plus-fill" viewBox="0 0 16 16">
                    <path d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/>
                    <path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5"/>
                </svg>
                <!-- <input class="search-input" placeholder="Search in recent chats..."> -->
                <div class="icons">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-three-dots-vertical" viewBox="0 0 16 16">
                        <path d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0"/>
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bell-fill" viewBox="0 0 16 16">
                        <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2m.995-14.901a1 1 0 1 0-1.99 0A5 5 0 0 0 3 6c0 1.098-.5 6-2 7h14c-1.5-1-2-5.902-2-7 0-2.42-1.72-4.44-4.005-4.901"/>
                    </svg>
                </div>
                <br>
                <input type="text" id="chat-search" class="search-input hidden" placeholder="Search in recent chats...">
                <input type="text" id="friend-search" class="search-input hidden" placeholder="Search in new friends...">
                <input type="text" id="friend-plus" class="search-input hidden" placeholder="Search in plus friends...">
                <div id="search-results" class="search-results"></div>
            </div>
            <div class="Right" id="main" data-user="{{ json_encode($user) }}"></div>
        </div>
    </div>
@endsection





<style>
    .flex-container {
        display: flex;
        align-items: flex-start; /* Align items at the top of the container */
        border: 1px solid white;
        gap: 0.1cm;
        background-color: #00008a;
        padding: 10px; /* Adjust padding as needed */
        margin-top: 25px;
        height: 67%;
    }

    .Left {
        flex-shrink: 0; /* Prevent the Left element from shrinking */
        display: flex;
        flex-direction: column; /* Align items vertically */
        align-items: flex-start; /* Align items to the left */
    }

    .Left svg {
        cursor: pointer;
        color: white;
        margin-bottom: 15px;
    }

    .Left svg:hover {
        color: red;
    }

    .search-input {
        width: 200px;
        font-size: 16px;
        border: 1px solid white;
        border-radius: 4px;
        padding: 5px; /* Add padding inside the search field */
    }

    .hidden {
        display: none; /* Hide elements */
    }

    .Right {
        color: white;
        margin-bottom: -55px;
        flex-shrink: 0; /* Prevent the Right element from shrinking */
        align-items: flex-start;
    }

    .icons {
        /* Add any additional styles for the icons container if needed */
    }

    .search-results {
        margin-top: 10px;
        border: 1px solid #ddd;
        border-radius: 4px;
        background: #fff;
        padding: 10px;
        max-height: 200px; /* Limit the height of the results container */
        overflow-y: auto; /* Add scroll if content exceeds height */
    }

    .user-result {
        display: flex;
        align-items: center;
        padding: 5px;
        border-bottom: 1px solid #ddd;
    }

    .user-result:last-child {
        border-bottom: none;
    }

    .user-photo {
        border-radius: 50%;
        margin-right: 10px;
    }
</style>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        const chatIcon = document.getElementById('chat-icon');
        const personIcon = document.getElementById('person-icon');
        const plusIcon = document.getElementById('plus-icon');
        const chatSearch = document.getElementById('chat-search');
        const friendSearch = document.getElementById('friend-search');
        const friendPlusSearch = document.getElementById('friend-plus');
        const searchResults = document.getElementById('search-results');
        const chatBox = document.querySelector('ChatBox'); // Assuming this is how you access the ChatBox component

        function fetchUsers(query) {
            fetch(`/users?query=${query}`)
                .then(response => response.json())
                .then(data => {
                    searchResults.innerHTML = '';
                    data.forEach(user => {
                        const userElement = document.createElement('div');
                        userElement.classList.add('user-result');
                        userElement.dataset.userId = user.id; // Store user ID
                        userElement.innerHTML = `
                            <img src="{{ asset('images') }}/${user.photo}" alt="${user.name}" class="user-photo" style="width: 50px; height: 50px; object-fit: cover;">
                            <span>${user.name}</span>
                        `;
                        searchResults.appendChild(userElement);
                    });
                });
        }

        chatIcon.addEventListener('click', function() {
            chatSearch.classList.remove('hidden');
            friendSearch.classList.add('hidden');
            friendPlusSearch.classList.add('hidden');
        });

        personIcon.addEventListener('click', function() {
            friendSearch.classList.remove('hidden');
            chatSearch.classList.add('hidden');
            friendPlusSearch.classList.add('hidden');
        });

        plusIcon.addEventListener('click', function() {
            friendPlusSearch.classList.remove('hidden');
            chatSearch.classList.add('hidden');
            friendSearch.classList.add('hidden');
        });

        friendSearch.addEventListener('input', function() {
            const query = friendSearch.value.trim();
            fetchUsers(query);
        });

        searchResults.addEventListener('click', function(event) {
            const userElement = event.target.closest('.user-result');
            if (userElement) {
                const userId = userElement.dataset.userId;
                if (chatBox) {
                    // Assuming ChatBox is a React component and you have a way to update its props
                    chatBox.setState({ selectedUserId: userId }); // Update ChatBox with selected user ID
                }
                friendSearch.value = ''; // Clear the search input
                searchResults.innerHTML = ''; // Clear search results
            }
        });
    });
</script>


