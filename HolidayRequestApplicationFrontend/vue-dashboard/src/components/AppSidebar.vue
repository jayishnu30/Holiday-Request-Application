<template>
  <div class="sidebar">
    <h2>Zitro Assignment</h2>
    <ul>
      <li><a href="#">Employees</a></li>
      <li><a href="#">Holidays</a></li>
    </ul>
  </div>
</template>

<script>
export default {
  name: "CustomSidebar", // Updated to follow multi-word naming rule
};
</script>

<style scoped>
.sidebar {
  background-color: #2c3e50; /* Dark blue background */
  color: white; /* White text color */
  width: 200px;
  height: 100vh; /* Full viewport height */
  padding: 20px;
  position: fixed;
  top: 0;
  left: 0;
}

.sidebar h2 {
  font-size: 1.5em;
  font-weight: bold;
  color: white;
  margin-bottom: 20px;
}

.sidebar ul {
  list-style: none;
  padding: 0;
}

.sidebar ul li {
  margin-bottom: 15px;
}

.sidebar ul li a {
  color: white;
  text-decoration: none;
  font-size: 1.1em;
  transition: color 0.3s;
}

.sidebar ul li a:hover {
  color: #3498db; /* Light blue on hover */
}
</style>
