<?php

namespace Pentatrion\ViteBundle\Twig;

use Pentatrion\ViteBundle\Asset\EntrypointRenderer;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class EntryFilesTwigExtension extends AbstractExtension
{
  private $entrypointRenderer;

  public function __construct(EntrypointRenderer $entrypointRenderer)
  {
    $this->entrypointRenderer = $entrypointRenderer;
  }

  public function getFunctions()
  {
    return [
      new TwigFunction('vite_entry_script_tags', [$this, 'renderViteScriptTags'], ['is_safe' => ['html']]),
      new TwigFunction('vite_entry_link_tags', [$this, 'renderViteLinkTags'], ['is_safe' => ['html']]),
    ];
  }

  public function renderViteScriptTags(string $entryName, array $options = []): string
  {
    return $this->entrypointRenderer->renderScripts($entryName, $options);
  }

  public function renderViteLinkTags(string $entryName, array $options = []): string
  {
    return $this->entrypointRenderer->renderLinks($entryName, $options);
  }
}
