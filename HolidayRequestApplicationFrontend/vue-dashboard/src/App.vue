<template>
    <div id="app">
      <div class="sidebar">
        <button class="burger" @click="toggleSidebar">☰</button>
        <h1>Zitro Assignment</h1>
        <nav>
          <ul>
            <li>Employees</li>
            <li>Holidays</li>
          </ul>
        </nav>
      </div>
      <div class="main-content">
        <Header />
        <HolidayTable />
      </div>
    </div>
  </template>
  
  <script>
  import Header from "./components/AppHeader.vue";
  import HolidayTable from "./views/HolidayTable.vue";
  
  export default {
    name: "App",
    components: {
      Header,
      HolidayTable
    },
    data() {
      return {
        sidebarOpen: true
      };
    },
    methods: {
      toggleSidebar() {
        this.sidebarOpen = !this.sidebarOpen;
      }
    }
  };
  </script>
  
  <style scoped>
  #app {
    display: flex;
  }
  
  .sidebar {
    width: 200px;
    background-color: #2d3e50;
    color: white;
    padding: 20px;
    position: fixed;
    top: 0;
    left: 0;
    bottom: 0;
    display: flex;
    flex-direction: column;
    align-items: start;
  }
  
  .burger {
    background: none;
    border: none;
    color: white;
    font-size: 1.5rem;
    cursor: pointer;
    margin-bottom: 10px;
  }
  
  .main-content {
    margin-left: 200px;
    padding: 20px;
    width: 100%;
  }
  
  h1 {
    margin-bottom: 20px;
  }
  
  nav ul {
    list-style: none;
    padding: 0;
    margin: 0;
  }
  
  nav li {
    margin: 10px 0;
    color: white;
  }
  </style>
  