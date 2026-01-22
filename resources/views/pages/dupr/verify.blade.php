<div class="h-full w-full" x-data="{
    handleDuprMessage(event) {
        if (!event.origin.includes('dupr.gg') && !event.origin.includes('dupr.com')) {
            return;
        }

        const data = event.data;

        if (data.userToken && data.refreshToken) {
            $wire.call('handleDuprLogin', {
                userToken: data.userToken,
                refreshToken: data.refreshToken,
                userId: data.id,
                duprId: data.duprId,
                stats: data.stats
            });
        }
    }
}" x-init="window.addEventListener('message', (event) => handleDuprMessage(event));">
  <iframe class="h-full w-full border-0" scrolling="no" src="{{ $this->getIframeSrc() }}"></iframe>
</div>
