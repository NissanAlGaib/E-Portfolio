/**
 * Pagination utility for admin pages
 * Provides search, filter, sort, and pagination functionality
 */
class PaginationManager {
  constructor(config) {
    this.items = [];
    this.filteredItems = [];
    this.currentPage = 1;
    this.itemsPerPage = config.itemsPerPage || 10;
    this.searchTerm = "";
    this.sortBy = config.defaultSort || "";
    this.sortOrder = "asc";
    this.filters = {};

    // Callbacks
    this.renderCallback = config.renderCallback;
    this.searchFields = config.searchFields || [];
    this.filterFields = config.filterFields || [];
    this.sortFields = config.sortFields || [];

    // Container IDs
    this.containerId = config.containerId;
    this.paginationId = config.paginationId;
    this.searchInputId = config.searchInputId;
    this.itemsPerPageId = config.itemsPerPageId;
    this.sortSelectId = config.sortSelectId;
  }

  setItems(items) {
    this.items = items;
    this.applyFilters();
  }

  applyFilters() {
    let filtered = [...this.items];

    // Apply search
    if (this.searchTerm) {
      const term = this.searchTerm.toLowerCase();
      filtered = filtered.filter((item) => {
        return this.searchFields.some((field) => {
          const value = this.getNestedProperty(item, field);
          return value && value.toString().toLowerCase().includes(term);
        });
      });
    }

    // Apply custom filters
    Object.keys(this.filters).forEach((filterKey) => {
      const filterValue = this.filters[filterKey];
      if (filterValue && filterValue !== "all") {
        filtered = filtered.filter((item) => {
          const itemValue = this.getNestedProperty(item, filterKey);
          return itemValue === filterValue;
        });
      }
    });

    // Apply sorting
    if (this.sortBy) {
      filtered.sort((a, b) => {
        const aVal = this.getNestedProperty(a, this.sortBy);
        const bVal = this.getNestedProperty(b, this.sortBy);

        if (aVal === null || aVal === undefined) return 1;
        if (bVal === null || bVal === undefined) return -1;

        let comparison = 0;
        if (typeof aVal === "string") {
          comparison = aVal.localeCompare(bVal);
        } else {
          comparison = aVal < bVal ? -1 : aVal > bVal ? 1 : 0;
        }

        return this.sortOrder === "asc" ? comparison : -comparison;
      });
    }

    this.filteredItems = filtered;
    this.currentPage = 1;
    this.render();
  }

  getNestedProperty(obj, path) {
    return path.split(".").reduce((curr, prop) => curr?.[prop], obj);
  }

  search(term) {
    this.searchTerm = term;
    this.applyFilters();
  }

  setFilter(filterKey, value) {
    this.filters[filterKey] = value;
    this.applyFilters();
  }

  sort(field, order) {
    this.sortBy = field;
    this.sortOrder = order || this.sortOrder;
    this.applyFilters();
  }

  toggleSortOrder() {
    this.sortOrder = this.sortOrder === "asc" ? "desc" : "asc";
    this.applyFilters();
  }

  setItemsPerPage(count) {
    this.itemsPerPage = parseInt(count);
    this.currentPage = 1;
    this.render();
  }

  goToPage(page) {
    const totalPages = this.getTotalPages();
    if (page >= 1 && page <= totalPages) {
      this.currentPage = page;
      this.render();
    }
  }

  nextPage() {
    this.goToPage(this.currentPage + 1);
  }

  prevPage() {
    this.goToPage(this.currentPage - 1);
  }

  getTotalPages() {
    return Math.ceil(this.filteredItems.length / this.itemsPerPage);
  }

  getCurrentPageItems() {
    const start = (this.currentPage - 1) * this.itemsPerPage;
    const end = start + this.itemsPerPage;
    return this.filteredItems.slice(start, end);
  }

  render() {
    const pageItems = this.getCurrentPageItems();

    // Render items using callback
    if (this.renderCallback) {
      this.renderCallback(pageItems);
    }

    // Render pagination controls
    this.renderPaginationControls();
  }

  renderPaginationControls() {
    const container = document.getElementById(this.paginationId);
    if (!container) return;

    const totalPages = this.getTotalPages();
    const totalItems = this.filteredItems.length;
    const start = (this.currentPage - 1) * this.itemsPerPage + 1;
    const end = Math.min(start + this.itemsPerPage - 1, totalItems);

    if (totalItems === 0) {
      container.innerHTML =
        '<p class="text-gray-400 text-center">No items to display</p>';
      return;
    }

    let html = `
      <div class="flex flex-col sm:flex-row items-center justify-between gap-4 mt-6">
        <div class="text-gray-400 text-sm">
          Showing <span class="text-white font-semibold">${start}</span> to 
          <span class="text-white font-semibold">${end}</span> of 
          <span class="text-white font-semibold">${totalItems}</span> items
        </div>
        
        <div class="flex items-center space-x-2">
          <button 
            onclick="pagination.prevPage()" 
            ${this.currentPage === 1 ? "disabled" : ""}
            class="px-4 py-2 bg-gray-700 text-white rounded-lg hover:bg-gray-600 transition disabled:opacity-50 disabled:cursor-not-allowed">
            Previous
          </button>
          
          <div class="flex space-x-1">
    `;

    // Page numbers
    const maxVisiblePages = 5;
    let startPage = Math.max(
      1,
      this.currentPage - Math.floor(maxVisiblePages / 2)
    );
    let endPage = Math.min(totalPages, startPage + maxVisiblePages - 1);

    if (endPage - startPage < maxVisiblePages - 1) {
      startPage = Math.max(1, endPage - maxVisiblePages + 1);
    }

    if (startPage > 1) {
      html += `<button onclick="pagination.goToPage(1)" class="px-3 py-2 bg-gray-700 text-white rounded-lg hover:bg-gray-600 transition">1</button>`;
      if (startPage > 2) {
        html += `<span class="px-2 text-gray-400">...</span>`;
      }
    }

    for (let i = startPage; i <= endPage; i++) {
      const isActive = i === this.currentPage;
      html += `
        <button 
          onclick="pagination.goToPage(${i})" 
          class="px-3 py-2 ${
            isActive ? "bg-blue-600" : "bg-gray-700"
          } text-white rounded-lg hover:bg-${
        isActive ? "blue-700" : "gray-600"
      } transition">
          ${i}
        </button>
      `;
    }

    if (endPage < totalPages) {
      if (endPage < totalPages - 1) {
        html += `<span class="px-2 text-gray-400">...</span>`;
      }
      html += `<button onclick="pagination.goToPage(${totalPages})" class="px-3 py-2 bg-gray-700 text-white rounded-lg hover:bg-gray-600 transition">${totalPages}</button>`;
    }

    html += `
          </div>
          
          <button 
            onclick="pagination.nextPage()" 
            ${this.currentPage === totalPages ? "disabled" : ""}
            class="px-4 py-2 bg-gray-700 text-white rounded-lg hover:bg-gray-600 transition disabled:opacity-50 disabled:cursor-not-allowed">
            Next
          </button>
        </div>
      </div>
    `;

    container.innerHTML = html;
  }

  renderSearchAndFilters(options = {}) {
    return `
      <div class="bg-dark-bg/50 backdrop-blur-sm rounded-lg p-4 border border-white/10 mb-6">
        <div class="grid grid-cols-1 md:grid-cols-${
          options.filterSelects ? options.filterSelects.length + 2 : "3"
        } gap-4">
          <!-- Search -->
          <div class="md:col-span-${
            options.fullWidthSearch
              ? options.filterSelects
                ? options.filterSelects.length + 2
                : 3
              : "1"
          }">
            <input
              type="text"
              id="${this.searchInputId}"
              placeholder="${options.searchPlaceholder || "Search..."}"
              onkeyup="pagination.search(this.value)"
              class="w-full px-4 py-2 bg-dark-bg/80 border border-white/10 rounded-lg text-white focus:outline-none focus:border-blue-500">
          </div>

          ${
            options.filterSelects
              ? options.filterSelects
                  .map(
                    (filter) => `
            <div>
              <select
                onchange="pagination.setFilter('${filter.field}', this.value)"
                class="w-full px-4 py-2 bg-dark-bg/80 border border-white/10 rounded-lg text-white focus:outline-none focus:border-blue-500">
                <option value="all">${filter.label}</option>
                ${filter.options
                  .map(
                    (opt) =>
                      `<option value="${opt.value}">${opt.label}</option>`
                  )
                  .join("")}
              </select>
            </div>
          `
                  )
                  .join("")
              : ""
          }

          <!-- Sort -->
          ${
            options.sortOptions
              ? `
            <div>
              <select
                id="${this.sortSelectId}"
                onchange="pagination.sort(this.value, 'asc')"
                class="w-full px-4 py-2 bg-dark-bg/80 border border-white/10 rounded-lg text-white focus:outline-none focus:border-blue-500">
                <option value="">Sort by...</option>
                ${options.sortOptions
                  .map(
                    (opt) =>
                      `<option value="${opt.value}">${opt.label}</option>`
                  )
                  .join("")}
              </select>
            </div>
          `
              : ""
          }

          <!-- Items per page -->
          <div>
            <select
              id="${this.itemsPerPageId}"
              onchange="pagination.setItemsPerPage(this.value)"
              class="w-full px-4 py-2 bg-dark-bg/80 border border-white/10 rounded-lg text-white focus:outline-none focus:border-blue-500">
              <option value="5">5 per page</option>
              <option value="10" selected>10 per page</option>
              <option value="25">25 per page</option>
              <option value="50">50 per page</option>
              <option value="100">100 per page</option>
            </select>
          </div>
        </div>
      </div>
    `;
  }
}
