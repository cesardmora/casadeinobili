@props(['properties' => collect(), 'inquiryType' => null])

<div class="contact-form-container" style="position: relative; z-index: 50;">
    <form action="{{ route('inquiry.store') }}" method="POST" class="space-y-6">
        @csrf
        @if($inquiryType)
            <input type="hidden" name="inquiry_type" value="{{ $inquiryType }}">
        @endif

        <div class="grid sm:grid-cols-2 gap-4">
            <div>
                <input type="text" name="name" placeholder="Your name *" required 
                    class="w-full px-6 py-4 border" 
                    style="background: rgba(255,255,255,0.05); border: 1px solid #b8956b; color: white;">
            </div>
            <div>
                <input type="email" name="email" placeholder="Your email *" required 
                    class="w-full px-6 py-4 border" 
                    style="background: rgba(255,255,255,0.05); border: 1px solid #b8956b; color: white;">
            </div>
        </div>

        {{-- Selección de Propiedad --}}
        @if($properties && $properties->count() > 0)
            <div class="mt-4">
                <select name="property_id" class="w-full px-6 py-4 border" 
                    style="background: #1a2a3a; border: 1px solid #b8956b; color: white;">
                    <option value="">Select Property</option>
                    @foreach($properties as $item) {{-- Cambiado $property por $item para evitar conflictos --}}
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>
        @endif

        <div class="mt-4">
            <textarea name="message" rows="5" placeholder="Your message *" required 
                class="w-full px-6 py-4 border" 
                style="background: rgba(255,255,255,0.05); border: 1px solid #b8956b; color: white;"></textarea>
        </div>

        <button type="submit" class="btn-editorial" 
            style="background: #b8956b; color: white; padding: 15px 40px; text-transform: uppercase; letter-spacing: 2px; cursor: pointer; border: none; margin-top: 20px;">
            Send Inquiry
        </button>
    </form>
</div>
