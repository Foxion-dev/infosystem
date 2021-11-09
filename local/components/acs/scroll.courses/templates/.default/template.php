<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>

<?if($arResult['SECTIONS']):?>
	<?$count=0?>
	<?foreach($arResult['SECTIONS'] as $firstSecKey => $firstSecVal):?>
		<div class="tab<?=$count==0 ? ' first':''?>" id="tab_<?=$firstSecKey?>">
			<?$count++?>
			<table class="table-price">
				<thead>
					<tr class="name">
						<td colspan="<?=count($arResult['FILED'])?>">
							<?=$firstSecVal['NAME']?>
						</td>
					</tr>
					<?if($arResult['FILED']):?>
						<tr class="property">
							<?foreach($arResult['FILED'] as $filed):?>
								<td><?=$filed["NAME"]?></td>
							<?endforeach?>
						</tr>
					<?endif?>
				</thead>
				<?if($firstSecVal['CHILD'] || $arResult['ITEMS'][$firstSecVal['ID']]):?>
					<tbody>
						<?if($arResult['ITEMS'][$firstSecVal['ID']]):?>
							<?foreach($arResult['ITEMS'][$firstSecVal['ID']] as $itemKey => $itemVal):?>
								<tr class="items">
									<?foreach($arResult['FILED'] as $filed):?>
										<?if($filed['CODE'] != 'NAME'):?>
											<td class="item-in-val <?=$filed['CODE']?>">
												<?if($itemVal['PROPERTIES'][$filed['CODE']]['VALUE']):?>
													<?if($itemVal['PROPERTIES'][$filed['CODE']]['MULTIPLE'] == "Y"):?>
														<?foreach($itemVal['PROPERTIES'][$filed['CODE']]['VALUE'] as $valIn):?>
															<span><?=$valIn?></span>
														<?endforeach?>
													<?else:?>
														<span><?=$itemVal['PROPERTIES'][$filed['CODE']]['VALUE']?></span>
													<?endif?>
												<?else:?>
													<span><?=GetMessage('EMPTY')?></span>
												<?endif?>
											</td>
										<?else:?>
											<td class="item-in-val <?=$filed['CODE']?>"><span><?=$itemVal['NAME']?></span></td>
										<?endif?>
									<?endforeach?>
								</tr>
							<?endforeach?>
						<?endif?>
						<?if($firstSecVal['CHILD']):?>
							<?foreach($firstSecVal['CHILD'] as $childSectKey => $childSectVal):?>
								<tr class="name-in">
									<td colspan="<?=count($arResult['FILED'])?>">
										<?=$childSectVal['NAME']?>
									</td>
								</tr>
								<?if($arResult['ITEMS'][$childSectVal['ID']]):?>
									<?foreach($arResult['ITEMS'][$childSectVal['ID']] as $itemKey => $itemVal):?>
										<tr class="items">
											<?foreach($arResult['FILED'] as $filed):?>
												<?if($filed['CODE'] != 'NAME'):?>
													<td class="item-in-val <?=$filed['CODE']?>">
														<?if($itemVal['PROPERTIES'][$filed['CODE']]['VALUE']):?>
															<?if($itemVal['PROPERTIES'][$filed['CODE']]['MULTIPLE'] == "Y"):?>
																<?foreach($itemVal['PROPERTIES'][$filed['CODE']]['VALUE'] as $valIn):?>
																	<span><?=$valIn?></span>
																<?endforeach?>
															<?else:?>
																<span><?=$itemVal['PROPERTIES'][$filed['CODE']]['VALUE']?></span>
															<?endif?>
														<?else:?>
															<span><?=GetMessage('EMPTY')?></span>
														<?endif?>
													</td>
												<?else:?>
													<td class="item-in-val <?=$filed['CODE']?>"><span><?=$itemVal['NAME']?></span></td>
												<?endif?>
											<?endforeach?>
										</tr>
									<?endforeach?>
								<?endif?>
							<?endforeach?>
						<?endif?>
					</tbody>
				<?endif?>
			</table>
		</div>
	<?endforeach?>
<?endif?>