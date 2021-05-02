@extends('layouts.Home')
@section('content')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.css">
<script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <livewire:navigationcc />

  <div class="duration-150 ease-in dark:bg-mjtheme-dark bg-mjtheme-white transition-colors min-h-screen pt-16">
    <div class="px-6 py-8">


    @livewire('layout.breadcrumbs', ['pages' => 'shops'])
<div class="flex justify-center overflow-x-hidden dark:bg-black bg-white">
    <div class="container pt-8 mx-auto" x-data="loadEmployees()" x-init="init()">
       <input
         x-ref="searchField"
         x-model="search"
         x-on:click="viewPage(0)"
         x-on:keydown.window.prevent.slash=" viewPage(0), $refs.searchField.focus()"
         placeholder="Search for an employee..."
         type="search"
         class="block w-full bg-gray-200 focus:outline-none focus:bg-white focus:shadow text-gray-700 font-bold rounded-lg px-4 py-3"
       />
       <div class="mt-4 grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
         <template x-for="item in filteredEmployees" :key="item">
           <div
             class="flex items-center shadow hover:bg-indigo-100 hover:shadow-lg hover:rounded transition duration-150 ease-in-out transform hover:scale-105 p-3"
           >
           <div class="w-full max-w-sm mx-auto rounded-md shadow-md overflow-hidden">
                               <div class="flex items-end justify-end h-56 w-full bg-cover" x-bind:style="`background-image: url(${item.profile_image})`">
                                   <button class="p-2 rounded-full bg-blue-600 text-white mx-5 -mb-4 hover:bg-blue-500 focus:outline-none focus:bg-blue-500">
                                       <svg class="h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                   </button>
                               </div>
                               <div class="px-5 py-3">
                                   <h3 class="text-gray-700 uppercase"  x-text="'$'+item.employee_salary/100"></h3>
                                   <span class="text-gray-500 mt-2" x-text="item.employee_name + ' (' + item.employee_age + ')'"></span>
                               </div>
                           </div>



             <!-- <img
               class="w-10 h-10 rounded-full mr-4"
               :src="`${item.profile_image}`"
             /> -->
           </div>
         </template>
       </div>

       <div
         class="w-full md:w-1/2 mx-auto py-6 flex justify-between items-center"
         x-show="pageCount() > 1"
       >
         <!--First Button-->
         <button
           x-on:click="viewPage(0)"
           :disabled="pageNumber==0"
           :class="{ 'disabled cursor-not-allowed text-gray-600' : pageNumber==0 }"
         >
           <svg
             class="h-8 w-8 text-indigo-600"
             width="24"
             height="24"
             viewBox="0 0 24 24"
             fill="none"
             stroke="currentColor"
             stroke-width="2"
             stroke-linecap="round"
             stroke-linejoin="round"
           >
             <polygon points="19 20 9 12 19 4 19 20"></polygon>
             <line x1="5" y1="19" x2="5" y2="5"></line>
           </svg>
         </button>

         <!--Previous Button-->
         <button
           x-on:click="prevPage"
           :disabled="pageNumber==0"
           :class="{ 'disabled cursor-not-allowed text-gray-600' : pageNumber==0 }"
         >
           <svg
             class="h-8 w-8 text-indigo-600"
             width="24"
             height="24"
             viewBox="0 0 24 24"
             fill="none"
             stroke="currentColor"
             stroke-width="2"
             stroke-linecap="round"
             stroke-linejoin="round"
           >
             <polyline points="15 18 9 12 15 6"></polyline>
           </svg>
         </button>

         <!-- Display page numbers -->
         <template x-for="(page,index) in pages()" :key="index">
           <button
             class="px-3 py-2 rounded"
             :class="{ 'bg-indigo-600 text-white font-bold' : index === pageNumber }"
             type="button"
             x-on:click="viewPage(index)"
           >
             <span x-text="index+1"></span>
           </button>
         </template>

         <!--Next Button-->
         <button
           x-on:click="nextPage"
           :disabled="pageNumber >= pageCount() -1"
           :class="{ 'disabled cursor-not-allowed text-gray-600' : pageNumber >= pageCount() -1 }"
         >
           <svg
             class="h-8 w-8 text-indigo-600"
             width="24"
             height="24"
             viewBox="0 0 24 24"
             fill="none"
             stroke="currentColor"
             stroke-width="2"
             stroke-linecap="round"
             stroke-linejoin="round"
           >
             <polyline points="9 18 15 12 9 6"></polyline>
           </svg>
         </button>

         <!--Last Button-->
         <button
           x-on:click="viewPage(Math.ceil(total/size)-1)"
           :disabled="pageNumber >= pageCount() -1"
           :class="{ 'disabled cursor-not-allowed text-gray-600' : pageNumber >= pageCount() -1 }"
         >
           <svg
             class="h-8 w-8 text-indigo-600"
             width="24"
             height="24"
             viewBox="0 0 24 24"
             fill="none"
             stroke="currentColor"
             stroke-width="2"
             stroke-linecap="round"
             stroke-linejoin="round"
           >
             <polygon points="5 4 15 12 5 20 5 4"></polygon>
             <line x1="19" y1="5" x2="19" y2="19"></line>
           </svg>
         </button>
       </div>

       <div>
         <div
           class="mt-6 flex flex-wrap justify-between items-center text-sm leading-5 text-gray-700"
         >
           <div
             class="w-full sm:w-auto text-center sm:text-left"
             x-show="pageCount() > 1"
           >
             Page <span x-text="pageNumber+1"> </span> of
             <span x-text="pageCount()"></span> | Showing
             <span x-text="startResults()"></span> to
             <span x-text="endResults()"></span>
           </div>

           <div
             class="w-full sm:w-auto text-center sm:text-right"
             x-show="total > 0"
           >
             Total <span class="font-bold" x-text="total"></span> results
           </div>

           <!--Message to display when no results-->
           <div
             class="mx-auto flex flex-col items-center font-bold text-red-500"
             x-show="total===0"
           >
           <img src="https://www.manypixels.co/assets/Illustrations/Gallery/cats.png" alt="">
           <div class="flex items-center">

             <svg
               class="h-8 w-8 text-red-500"
               viewBox="0 0 24 24"
               stroke-width="2"
               stroke="currentColor"
               fill="none"
               stroke-linecap="round"
               stroke-linejoin="round"
             >
               <path stroke="none" d="M0 0h24v24H0z" />
               <circle cx="12" cy="12" r="9" />
               <line x1="9" y1="10" x2="9.01" y2="10" />
               <line x1="15" y1="10" x2="15.01" y2="10" />
               <path d="M9.5 16a10 10 0 0 1 6 -1.5" />
             </svg>

             <span class="ml-4"> No results!!</span>
           </div>
           </div>
         </div>
       </div>
     </div>
     </div>
         </div>
     <script async>
       function loadEmployees() {
         return {
           search: "",
           pageNumber: 0,
           size: 10,
           total: "",
           myForData: [],
            reload() {
              sessionStorage.clear("Products");
              this.myForData = [];
              this.init();
            },
            init() {
              const myForData = JSON.parse(window.sessionStorage.getItem('Products'));
              if(myForData){
            // make it accessible to x-data
            this.myForData = myForData;
            console.log('sessionStorage', myForData);
            return;
            }
              fetch("https://api.chec.io/v1/products?limit=25", {
                headers: {
                  "X-Authorization": "{{ config('app.productlist') }}"
                }
              }).then(response => response.json())
              .then(response => {
                console.log('fetched',response.data);
                // I could use collect.js to manipulate the response further.
                var dataConvertProdList = [];
                for (var i = 0; i < response.data.length; i++) {
                 dataConvertProdList.push({'id': i.toString(),
                  'employee_name': response.data[i].name,
                  'employee_salary': response.data[i].price.raw,
                  'employee_age': response.data[i].quantity.toString(),
                  'profile_image': response.data[i].media.source});
                }
                this.myForData = dataConvertProdList;
                sessionStorage.setItem("Products",JSON.stringify(dataConvertProdList));
              });

            },
           get filteredEmployees() {
             const start = this.pageNumber * this.size,
               end = start + this.size;

             if (this.search === "") {
               this.total = this.myForData.length;
               return this.myForData.slice(start, end);
             }

             //Return the total results of the filters
             this.total = this.myForData.filter((item) => {
               return item.employee_name
                 .toLowerCase()
                 .includes(this.search.toLowerCase());
             }).length;

             //Return the filtered data
             return this.myForData
               .filter((item) => {
                 return item.employee_name
                   .toLowerCase()
                   .includes(this.search.toLowerCase());
               })
               .slice(start, end);
           },

           //Create array of all pages (for loop to display page numbers)
           pages() {
             return Array.from({
               length: Math.ceil(this.total / this.size),
             });
           },

           //Next Page
           nextPage() {
             this.pageNumber++;
           },

           //Previous Page
           prevPage() {
             this.pageNumber--;
           },

           //Total number of pages
           pageCount() {
             return Math.ceil(this.total / this.size);
           },

           //Return the start range of the paginated results
           startResults() {
             return this.pageNumber * this.size + 1;
           },

           //Return the end range of the paginated results
           endResults() {
             let resultsOnPage = (this.pageNumber + 1) * this.size;

             if (resultsOnPage <= this.total) {
               return resultsOnPage;
             }

             return this.total;
           },

           //Link to navigate to page
           viewPage(index) {
             this.pageNumber = index;
           },
         };
       }

     </script>
    </div>


  </div>
  @livewire('layout.leftslider')
  <livewire:theme />
  <livewire:footer />
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.js"></script>
  <script type="text/javascript">
  $(document).ready( function () {
  $('#table_id').DataTable();

} );
  </script>

@endsection
