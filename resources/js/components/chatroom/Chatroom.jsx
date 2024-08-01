import React, { useState } from "react";

const Chatroom = () => {
  // Example state variables
  const [status, setStatus] = useState([]);
  const [notifications, setNotifications] = useState([]);
  const [query, setQuery] = useState("");
  const [placeholder, setPlaceholder] = useState("Search...");
  const [tab, setTab] = useState('recent-chat');
  const [recentChats, setRecentChats] = useState([]);
  const [queryRecentChats, setQueryRecentChats] = useState([]);
  const [friends, setFriends] = useState([]);
  const [queryFriendList, setQueryFriendList] = useState([]);
  const [searchResult, setSearchResult] = useState(null);

  // Example functions (define these as needed)
  const openTab = (tabName) => setTab(tabName);
  const addFriend = (senderId, notifId, isAccepted) => {};
  const markAsRead = (notifId, type) => {};
  const deleteAllChats = () => {};
  const search = (e) => {};
  const startChat = (friendId) => {};
  const unfriend = (friendId) => {};
  const sendFriendRequest = (friendId) => {};

  return (
    <div className="container">
     @include('model')
    </div>
  );
};

export default Chatroom;
