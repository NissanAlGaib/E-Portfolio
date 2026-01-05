/**
 * Modal Utility System
 * Provides reusable modal functions for alerts and confirmations
 */

class ModalManager {
  constructor() {
    this.activeModals = [];
    this.createModalContainer();
  }

  createModalContainer() {
    if (document.getElementById("modal-container")) return;

    const container = document.createElement("div");
    container.id = "modal-container";
    container.className = "fixed inset-0 z-50 pointer-events-none";

    // Ensure document.body exists before appending
    if (document.body) {
      document.body.appendChild(container);
    } else {
      document.addEventListener("DOMContentLoaded", () => {
        document.body.appendChild(container);
      });
    }
  }

  /**
   * Show an alert modal with a message
   * @param {string} message - The message to display
   * @param {string} type - The type of alert (success, error, info, warning)
   * @returns {Promise} - Resolves when the modal is closed
   */
  showAlert(message, type = "info") {
    return new Promise((resolve) => {
      const modalId = `modal-${Date.now()}`;
      const colors = {
        success: "from-green-600 to-green-700",
        error: "from-red-600 to-red-700",
        info: "from-blue-600 to-blue-700",
        warning: "from-yellow-600 to-yellow-700",
      };

      const icons = {
        success: "✓",
        error: "✕",
        info: "ℹ",
        warning: "⚠",
      };

      const colorClass = colors[type] || colors.info;
      const icon = icons[type] || icons.info;

      const modalHTML = `
        <div id="${modalId}" class="fixed inset-0 z-50 flex items-center justify-center pointer-events-auto animate-fade-in">
          <div class="absolute inset-0 bg-black/60 backdrop-blur-sm" onclick="window.modalManager.closeModal('${modalId}')"></div>
          <div class="relative bg-gray-900 border border-gray-700 rounded-lg shadow-2xl p-6 max-w-md w-full mx-4 animate-slide-up">
            <div class="flex items-start space-x-4">
              <div class="flex-shrink-0 w-12 h-12 rounded-full bg-gradient-to-br ${colorClass} flex items-center justify-center text-white text-2xl font-bold">
                ${icon}
              </div>
              <div class="flex-1 pt-1">
                <h3 class="text-lg font-semibold text-white mb-2">${this.getTitle(
                  type
                )}</h3>
                <p class="text-gray-300 text-sm">${message}</p>
              </div>
            </div>
            <div class="mt-6 flex justify-end">
              <button onclick="window.modalManager.closeModal('${modalId}')" 
                class="px-6 py-2 bg-gradient-to-r ${colorClass} text-white rounded-lg hover:opacity-90 transition-all transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-900 focus:ring-blue-500">
                OK
              </button>
            </div>
          </div>
        </div>
      `;

      const container = document.getElementById("modal-container");
      container.insertAdjacentHTML("beforeend", modalHTML);
      this.activeModals.push(modalId);

      // Store resolve function
      this.modalResolvers = this.modalResolvers || {};
      this.modalResolvers[modalId] = resolve;
    });
  }

  /**
   * Show a confirmation modal with Yes/No buttons
   * @param {string} message - The message to display
   * @param {string} confirmText - Text for confirm button (default: "Yes")
   * @param {string} cancelText - Text for cancel button (default: "No")
   * @returns {Promise<boolean>} - Resolves to true if confirmed, false if cancelled
   */
  showConfirm(message, confirmText = "Yes", cancelText = "No") {
    return new Promise((resolve) => {
      const modalId = `modal-${Date.now()}`;

      const modalHTML = `
        <div id="${modalId}" class="fixed inset-0 z-50 flex items-center justify-center pointer-events-auto animate-fade-in">
          <div class="absolute inset-0 bg-black/60 backdrop-blur-sm" onclick="window.modalManager.closeModal('${modalId}', false)"></div>
          <div class="relative bg-gray-900 border border-gray-700 rounded-lg shadow-2xl p-6 max-w-md w-full mx-4 animate-slide-up">
            <div class="flex items-start space-x-4">
              <div class="flex-shrink-0 w-12 h-12 rounded-full bg-gradient-to-br from-yellow-600 to-orange-700 flex items-center justify-center text-white text-2xl font-bold">
                ?
              </div>
              <div class="flex-1 pt-1">
                <h3 class="text-lg font-semibold text-white mb-2">Confirm Action</h3>
                <p class="text-gray-300 text-sm">${message}</p>
              </div>
            </div>
            <div class="mt-6 flex justify-end space-x-3">
              <button onclick="window.modalManager.closeModal('${modalId}', false)" 
                class="px-6 py-2 bg-gray-700 text-white rounded-lg hover:bg-gray-600 transition-all transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-900 focus:ring-gray-500">
                ${cancelText}
              </button>
              <button onclick="window.modalManager.closeModal('${modalId}', true)" 
                class="px-6 py-2 bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-lg hover:opacity-90 transition-all transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-900 focus:ring-blue-500">
                ${confirmText}
              </button>
            </div>
          </div>
        </div>
      `;

      const container = document.getElementById("modal-container");
      container.insertAdjacentHTML("beforeend", modalHTML);
      this.activeModals.push(modalId);

      // Store resolve function
      this.modalResolvers = this.modalResolvers || {};
      this.modalResolvers[modalId] = resolve;
    });
  }

  closeModal(modalId, result = true) {
    const modal = document.getElementById(modalId);
    if (!modal) return;

    // Add fade-out animation
    modal.style.opacity = "0";
    modal.style.transform = "scale(0.95)";

    setTimeout(() => {
      modal.remove();
      this.activeModals = this.activeModals.filter((id) => id !== modalId);

      // Resolve the promise
      if (this.modalResolvers && this.modalResolvers[modalId]) {
        this.modalResolvers[modalId](result);
        delete this.modalResolvers[modalId];
      }
    }, 200);
  }

  getTitle(type) {
    const titles = {
      success: "Success",
      error: "Error",
      info: "Information",
      warning: "Warning",
    };
    return titles[type] || "Information";
  }

  closeAll() {
    this.activeModals.forEach((modalId) => {
      this.closeModal(modalId, false);
    });
  }
}

// Initialize global modal manager after DOM is ready
if (document.readyState === "loading") {
  document.addEventListener("DOMContentLoaded", initModalManager);
} else {
  initModalManager();
}

function initModalManager() {
  window.modalManager = new ModalManager();

  // Convenience functions for easy access
  window.showAlert = (message, type = "info") =>
    window.modalManager.showAlert(message, type);
  window.showConfirm = (message, confirmText, cancelText) =>
    window.modalManager.showConfirm(message, confirmText, cancelText);
}

// Add CSS animations
const style = document.createElement("style");
style.textContent = `
  @keyframes fade-in {
    from { opacity: 0; }
    to { opacity: 1; }
  }

  @keyframes slide-up {
    from {
      opacity: 0;
      transform: translateY(20px) scale(0.95);
    }
    to {
      opacity: 1;
      transform: translateY(0) scale(1);
    }
  }

  .animate-fade-in {
    animation: fade-in 0.2s ease-out;
  }

  .animate-slide-up {
    animation: slide-up 0.3s ease-out;
  }
`;
document.head.appendChild(style);
