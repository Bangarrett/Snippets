<div>
    @if ($posts->count())
        <div class="container mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($posts as $post)
                    <div class="bg-white shadow-md rounded-lg p-4">
                        <p class="text-lg font-bold mb-5">{{ $post->titulo }}</p>
                        <a href="{{ route('posts.show', ['user' => $post->user, 'post' => $post]) }}">
                            @if ($post->imagen)
                                <img src="{{ asset('uploads') . '/' . $post->imagen }}"
                                    alt="Imagen del post {{ $post->titulo }}">
                            @endif
                        </a>

                        @auth
                            @php
                                $user = auth()->user();
                                $profileImage = $user->imagen ? asset('perfiles/' . $user->imagen) : asset('img/usuario.svg');
                            @endphp

                            @if ($user->id == $post->user_id)
                                <a href="{{ route('posts.index', ['user' => $user->username]) }}"
                                    class="font-bold flex  gap-2 centradoPerfil">
                                    <img src="{{ $profileImage }}" alt="Imagen de perfil" class="h-8 w-8 rounded-full">
                                    {{ $user->username }}
                                </a>
                            @else
                                @php
                                    $otherUser = $post->user;
                                    $otherProfileImage = $otherUser->imagen ? asset('perfiles/' . $otherUser->imagen) : asset('img/usuario.svg');
                                @endphp
                                <a href="{{ route('posts.index', ['user' => $otherUser->username]) }}"
                                    class="font-bold flex gap-2 centradoPerfil">
                                    <img src="{{ $otherProfileImage }}" alt="Imagen de perfil" class="h-8 w-8 rounded-full">
                                    {{ $otherUser->username }}
                                </a>
                            @endif
                        @endauth

                        <span class="p-3 flex items-center gap-4">
                            @auth
                                <livewire:like-post :post="$post" />
                            @endauth
                        </span>

                        <p class="text-sm text-gray-500">{{ $post->created_at->diffForHumans() }}</p>
                        <div class="descripcion-scroll">
                            <pre class="descripcion" onclick="mostrarDescripcion(this)">{{ $post->descripcion }}</pre>
                        </div>

                    </div>
                @endforeach
            </div>
        </div>

        <div id="descripcion-popup" class="descripcion-popup" style="display: none;">
            <div class="contenido">
                <div class="volver">
                    <button onclick="cerrarDescripcionPopup()">Volver</button>
                </div>
                <pre id="descripcion-popup-content"></pre>
            </div>
        </div>

        <script>
            function mostrarDescripcion(elemento) {
                var descripcion = elemento.textContent;
                var descripcionPopup = document.getElementById('descripcion-popup-content');
                descripcionPopup.textContent = descripcion;
                document.getElementById('descripcion-popup').style.display = 'flex';
            }

            function cerrarDescripcionPopup() {
                document.getElementById('descripcion-popup').style.display = 'none';
            }
        </script>
    @else
        <p class="text-center">No Hay Posts</p>
    @endif
</div>
