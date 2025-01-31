{{-- =================  CART POPUP START  ================================== --}}
<div class="modal fade" id="cartModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="productModalTitle">Product Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body productModalBody">
                {{-- Product details will be loaded here via AJAX
                        Here display product details from
                        layouts/ajax_files/product_popputs.blade.php --}}
            </div>
        </div>
    </div>
</div>

{{-- ================= CART POPUP END ================================== --}}
