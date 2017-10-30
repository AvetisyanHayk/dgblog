@extends('admin.layout.master')
@section('body')
    <div class="container">
        <main>
            @include('admin.partial.errors')

            @if(Session::has('result'))
                @if(Session::get('result') == 'edit-ok')
                    @include('admin.partial.info', ['message' => 'Հաջողվեց պահպանել փոփոխությունները'])
                @elseif(Session::get('result') == 'save-ok')
                    @include('admin.partial.info', ['message' => 'Հաջողվեց ստեղծել գրառումը'])
                @endif
            @endif
            <form method="post" class="form-hover">
                {{ csrf_field() }}

                <input type="hidden" id="id" name="id"
                       @if(isset($post))
                       value="{{ $post->id }}"
                        @endif
                />

                <div class="form-group">
                    <label for="id" class="col-sm-2 text-right control-label label-warning">
                        <span data-toggle="tooltip" title="Թողարկման հերթական համարը (պարտադիր դաշտ) [reference]"># <i
                                    class="fa fa-exclamation-circle"></i></span>
                    </label>
                    <div class="col-sm-10">
                        <input type="number" id="reference" name="reference" class="form-control"
                               placeholder="Հերթական համարը"
                               @if(isset($post))
                               value="{{ $post->reference }}"
                               @else
                               value="{{ old('reference') }}"
                                @endif
                        />
                    </div>
                </div>

                <div class="form-group">
                    <label for="title" class="col-sm-2 text-right control-label">Վերնագիր</label>
                    <div class="col-sm-10">
                        <input type="text" id="title" name="title" class="form-control" placeholder="Վերնագիր"
                               @if(isset($post) && isset($post->title))
                               value="{{ $post->title }}"
                               @else
                               value="{{ old('title') }}"
                                @endif
                        />
                    </div>
                </div>

                <div class="form-group">
                    <label for="content" class="col-sm-2 text-right control-label label-warning">
                        <span data-toggle="tooltip" title="Պարտադիր դաշտ [content]">Գրառում <i
                                    class="fa fa-exclamation-circle"></i></span></label>
                    <div class="col-sm-10">
                        @if(isset($post))
                            <textarea id="content" name="content" class="form-control" rows="10"
                                      placeholder="Գրառում">{{ $post->content }}</textarea>
                        @else
                            <textarea id="content" name="content" class="form-control" rows="10"
                                      placeholder="Գրառում">{{ old('content') }}</textarea>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <label for="urlid" class="col-sm-2 text-right control-label">Նույնացուցիչ</label>
                    <div class="col-sm-10">
                        <input type="text" id="urlid" name="urlid" class="form-control"
                               placeholder="Հղման նույնացուցիչ"
                               @if(isset($post) && isset($post->urlid))
                               value="{{ $post->urlid }}"
                               @else
                               value="{{ old('urlid') }}"
                                @endif
                        />
                    </div>
                </div>

                <div class="form-group">
                    <label for="date" class="col-sm-2 text-right control-label label-warning">
                        <span data-toggle="tooltip" title="Գրառման ստեղծման ամսաթիվը (պարտադիր դաշտ) [date]">Ամսաթիվ <i
                                    class="fa fa-exclamation-circle"></i></span></label>
                    <div class="col-sm-10">
                        <input type="date" id="date" name="date" class="form-control" placeholder="Ամսաթիվ"
                               @if(isset($post))
                               value="{{ $post->date }}"
                               @else
                               value="{{ old('date') }}"
                                @endif
                        />
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-2">&nbsp;</div>
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-info" data-type="spin-on-post">
                            <i class="fa fa-fw fa-save"></i> Պահպանել
                        </button>
                        <button type="reset" class="btn btn-success" data-type="disable-on-submit">
                            <i class="fa fa-fw fa-undo"></i> Վերականգնել
                        </button>
                        @if(isset($post))
                            <button type="button" class="btn btn-danger" data-toggle="modal"
                                    data-type="disable-on-submit" data-target="#modalDeletePost">
                                <i class="fa fa-fw fa-trash"></i> Ջնջել
                            </button>
                        @endif
                        <a class="btn btn-light" href="{{ route('_admin.posts') }}" role="button"
                           data-type="disable-on-submit">
                            <i class="fa fa-fw fa-remove"></i> Չեղարկել</a>
                    </div>
                </div>
            </form>

            @if(isset($post))
                <div class="modal fade" id="modalDeletePost" tabindex="-1" role="dialog"
                     aria-labelledby="modalDeletePostTitle" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalDeletePostTitle">
                                    <i class="fa fa-fw fa-exclamation-circle"></i> Ջնջել գրառումը</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                            </div>
                            <div class="modal-body">
                                <p>
                                    Դուք փորձում եք ջնջել #{{ $post->reference }} գրառումը, որն այլևս հնարավոր չի լինի
                                    վերականգնել:
                                </p>
                                <p class="no-margin">Խնդրում ենք հաստատել:</p>
                            </div>
                            <div class="modal-footer">
                                <form method="post" action="{{ route('_admin.post.delete', ['id' => $post->id]) }}">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="id" value="{{ $post->id }}"/>
                                    <button type="submit" class="btn btn-danger" data-type="spin-on-post">
                                        <i class="fa fa-fw fa-trash"></i> Ջնջել գրառումը
                                    </button>
                                </form>
                                <button type="button" class="btn btn-light" data-dismiss="modal">
                                    <i class="fa fa-fw fa-remove"></i> Փակել
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </main>
    </div>
@endsection