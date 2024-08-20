<?php
namespace App\Components;

class ValutaMenu
{
    private $id_studio;

    public function __construct($id_studio)
    {
        $this->id_studio = $id_studio;
    }

    public function __toString()
    {
        return '<div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-heading">Strumenti</div>
                <div class="panel-body">
                    <ul class="list-unstyled">
                        <li>
                            <a href="/utassistant/app/esperto/valutaAudioVideo.php?idstudio=' . $this->id_studio . '">
                                Video
                            </a>
                        </li>
                        <li><a href="/utassistant/smt2/admin/ext/admin-logs/partecipanti_studio.php?idstudio=' . $this->id_studio . '">Attività mouse</a></li>
						<li><a href="/utassistant/sankey/tasks_studio.php?idstudio=' . $this->id_studio . '">Sankey Diagram</a></li>
                        <li><a href="/utassistant/heatmap/tasks_studio.php?idstudio=' . $this->id_studio . '">Heatmap</a></li>
                        <li><a href="/utassistant/clickmap/tasks_studio.php?idstudio=' . $this->id_studio . '">Clickmap</a></li>
                        <li><a href="/utassistant/app/esperto/valuta_questionario.php?idstudio=' . $this->id_studio . '">Questionari</a></li>
                    </ul>
                </div>
            </div>
        </div>';
    }
}