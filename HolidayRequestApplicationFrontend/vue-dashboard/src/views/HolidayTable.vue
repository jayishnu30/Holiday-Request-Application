<template>
    <div>
      <!-- Search Bar -->
      <div class="search">
        <input v-model="searchName" placeholder="Search for name" />
        <input v-model="searchDepartment" placeholder="Search for Department" />
        <button @click="performSearch">Search</button>
      </div>
  
      <!-- Holiday Table -->
      <table>
        <thead>
          <tr>
            <th>Name</th>
            <th>Surname</th>
            <th>Department</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(employee, index) in filteredEmployees" :key="index">
            <td>{{ employee.name }}</td>
            <td>{{ employee.surname }}</td>
            <td>{{ employee.department }}</td>
            <td>
              <button 
                class="eye-button" 
                @click="toggleDetails(employee.name, $event)"
              >👁️</button>
              
              <!-- Popover for Requested Holidays -->
              <div 
                v-if="selectedEmployee === employee.name"
                class="popover"
                :style="{ top: popoverPosition.top + 'px', left: popoverPosition.left + 'px' }"
              >
                <h3>Requested Holidays</h3>
                <ul>
                  <li v-for="holiday in holidays[selectedEmployee]" :key="holiday">
                    {{ holiday }}
                  </li>
                </ul>
                <button class="cancel" @click="selectedEmployee = null">Cancel</button>
                <button class="validate">Validate</button>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        searchName: '',
        searchDepartment: '',
        selectedEmployee: null,
        popoverPosition: { top: 0, left: 0 },
        holidays: {
          "Erik Smith": ["From 01/02 to 13/02", "From 19/02 to 23/02", "From 03/04 to 08/04"]
          // Add more employee holidays here as needed
        },
        employees: [
          { name: 'Erik', surname: 'Smith', department: 'Accounting' },
          { name: 'Paul', surname: 'Cox', department: 'Accounting' },
          { name: 'William', surname: 'Terry', department: 'Product Analysis' },
          { name: 'Mark', surname: 'Spencer', department: 'Business & Services' },
          { name: 'Erik', surname: 'Smith', department: 'Software Development' }
        ]
      };
    },
    computed: {
      filteredEmployees() {
        return this.employees.filter(emp => {
          return (
            emp.name.toLowerCase().includes(this.searchName.toLowerCase()) &&
            emp.department.toLowerCase().includes(this.searchDepartment.toLowerCase())
          );
        });
      }
    },
    methods: {
      toggleDetails(name, event) {
        // Toggle the selected employee and set popover position
        this.selectedEmployee = this.selectedEmployee === name ? null : name;
  
        // Set popover position based on button position
        if (this.selectedEmployee) {
          const buttonRect = event.target.getBoundingClientRect();
          this.popoverPosition = {
            top: buttonRect.top + window.scrollY,
            left: buttonRect.left + window.scrollX + buttonRect.width + 10 // Adjust for placement to the right
          };
        }
      },
      performSearch() {
        // Placeholder for search logic if needed
      }
    }
  };
  </script>
  
  <style scoped>
  .search {
    display: flex;
    gap: 10px;
    margin-bottom: 20px;
    align-items: center;
  }
  
  .search input {
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 5px;
    outline: none;
    width: 200px;
  }
  
  .search button {
    padding: 8px 16px;
    background-color: #3498db;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s;
  }
  
  .search button:hover {
    background-color: #2980b9;
  }
  
  table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
  }
  
  table, th, td {
    border: 1px solid #ddd;
  }
  
  th, td {
    padding: 12px;
    text-align: left;
  }
  
  th {
    background-color: #3498db;
    color: white;
    font-weight: bold;
  }
  
  tbody tr:nth-child(even) {
    background-color: #f9f9f9;
  }
  
  tbody tr:hover {
    background-color: #f1f1f1;
  }
  
  button.eye-button {
    padding: 5px;
    background-color: #3498db;
    color: white;
    border: none;
    border-radius: 50%;
    font-size: 16px;
    transition: background-color 0.3s;
  }
  
  button.eye-button:hover {
    background-color: #2980b9;
  }
  
  /* Popover styles */
  .popover {
    position: absolute;
    background-color: #f9f9f9;
    padding: 15px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    width: 200px;
    z-index: 10;
  }
  
  .popover h3 {
    margin-top: 0;
  }
  
  .popover ul {
    list-style-type: none;
    padding: 0;
  }
  
  .popover li {
    padding: 5px 0;
  }
  
  .popover button {
    margin-top: 10px;
    padding: 8px 16px;
    border: none;
    border-radius: 5px;
  }
  
  .popover button.cancel {
    background-color: #e74c3c;
    color: white;
  }
  
  .popover button.validate {
    background-color: #2ecc71;
    color: white;
  }
  </style>
  